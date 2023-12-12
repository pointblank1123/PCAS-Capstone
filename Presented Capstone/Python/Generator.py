import random
import string
import random
import sys

def generate(length, upperlower, nums, special):
    length = int(length)
    charset = string.ascii_lowercase
    uppers = string.ascii_uppercase
    digits = string.digits
    specials = "!@#$%^&*"
    if upperlower == "on":
        charset += uppers
        loc = []
        for i in range (0,length):
            loc.append(i)
        requpper = random.choice(loc)
        loc.remove(requpper)
    if nums == "on":
        charset += digits
        reqnums = random.choice(loc)
        loc.remove(reqnums)
    if special == "on":
        charset += specials
        reqspecial = random.choice(loc)
    generated = ""

    for i in range(length):
        if i == requpper:
            generated += uppers[random.randint(0, len(uppers)-1)]
        elif i == reqnums:
            generated += digits[random.randint(0, len(digits)-1)]
        elif i == reqspecial:
            generated += specials[random.randint(0, len(special)-1)]
        else:
            generated += charset[random.randint(0, len(charset)-1)]

    return generated
    #f = open("Generated.txt", "a")
    #f.writelines(generated+"\n")


#generate(8, "on", "on", "on")
print(generate(sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4]))
