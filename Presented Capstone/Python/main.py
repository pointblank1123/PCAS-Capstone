#!/usr/bin/env python3
import requests
import SqlConnector
import sys


def run(pwdid, full):
    conn = SqlConnector.connect()
    print(str(pwdid) + " " + str(full))
    print(SqlConnector.view("SELECT COLUMN_NAME FROM Information_schema.columns WHERE table_name='passwords'", conn))
    if full == "False":
        pwd = SqlConnector.request("SELECT Password FROM passwords WHERE ID="+str(pwdid), conn)
        print(pwd)
        startScan(pwd, str(pwdid), conn)
    elif full == "True":
        pwds, pwdids = SqlConnector.fullrequest(conn)
        i = 0
        for pwd in pwds:
            #print(pwd)
            startScan(pwd, str(pwdids[i]), conn)
            i += 1
            print("-----------------------")


def startScan(pwd, pwdid, conn):
    hashlist = callAPI(pwd[:5])
    hasharray = handle(hashlist, pwd[:5])
    result = compare(pwd, hasharray)
    print(result)
    SqlConnector.updateRow("UPDATE passwords SET Compromised=" + result + " WHERE id=" + pwdid, conn)
    print(SqlConnector.view("SELECT * FROM passwords WHERE ID=" + pwdid, conn))


def callAPI(hashPWD):
    reqURL = "https://api.pwnedpasswords.com/range/"+hashPWD
    req = requests.get(reqURL)
    content = str(req.content)
    return content


def handle(response, pwd):
    response = response.replace("b'", "")
    response = response.split("\\r")
    hashArr = ""
    counter = 0
    fullhashArr = ""
    for i in response:
        hashArr += i

    hashArr = hashArr.split("\\n")

    while counter < len(hashArr):
        fullhashArr += pwd.upper() + hashArr[counter] + "\\n"
        #print(pwd + hashArr[counter])
        counter += 1

    fullhashArr = fullhashArr.split("\\n")
    return fullhashArr

def compare(password, hasharray):
    k = 0
    while True:
        password = password.upper()
        #print(hasharray[k].split(":")[0])
        #print(password)
        #print(hasharray[k].split(":")[0] == password)
        if hasharray[k].split(":")[0] == password:
            return "1"
        else:
            k += 1
            if k >= len(hasharray):
                return "0"


#run(1, True)
#run(12, False)

run("1", "True")
