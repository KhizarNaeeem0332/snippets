#!/usr/bin/python3


from random import randint

_try = 1


randomNumber = randint(1,10)

while _try < 6 :
    #user input
    userValue = int ( input("enter number from 1 to 10: ") )

    if randomNumber == userValue :
        print("all is well random number is " + str(randomNumber) )
        exit(0)
    else :
        print( str(5 - _try) + " tru left" )
        _try += 1
