import pyodbc
import hashlib

server = 'localhost'
database = 'Passwords'
username = 'admin'
password = 'PCASSql'
driver = '{MySQL}'

def connect():
    connectionString = f'DRIVER={driver};Server={server};DATABASE={database};UID={username};PWD={password}'

    return pyodbc.connect(connectionString)


def request(query, conn):
    cursor = conn.cursor()
    cursor.execute(query)
    records = cursor.fetchall()
    h = hashlib.new('sha1')
    encoded = records[0][0].encode()
    h.update(encoded)
    return h.hexdigest()


def fullrequest(conn):
    query = "SELECT password, ID FROM passwords"
    hashlist = []
    pwdids = []
    i = 0
    cursor = conn.cursor()
    cursor.execute(query)
    records = cursor.fetchall()

    while i < len(records):
        encoded = records[i][0].encode()
        h = hashlib.new('sha1')
        h.update(encoded)
        hashlist.append(h.hexdigest())
        pwdids.append(records[i][1])
        i += 1

    return hashlist, pwdids

def view(query, conn):
    cursor = conn.cursor()
    cursor.execute(query)
    records = cursor.fetchall()
    return records

def updateRow(query, conn):
    cursor = conn.cursor()
    cursor.execute(query)
    conn.commit()


conn = connect()
#request("SELECT website FROM passwords ", conn)
#request("SELECT password FROM passwords WHERE id=2", conn)
#print(view("SELECT COLUMN_NAME, DATA_TYPE FROM Information_schema.columns WHERE table_name='passwords'", conn))
#print(view("SELECT * FROM passwords ", conn))
#fullrequest(conn)
#updateRow("DELETE FROM passwords WHERE id=7", conn)
