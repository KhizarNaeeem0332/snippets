#!/usr/bin/python3

import tkinter as tk
from tkinter import ttk

#window setting
win = tk.Tk()
win.title("Simple Counter")
win.resizable(0,0)

number = 0

#funtions
def clickMe():
    global number
    number = number + 1
    lbl1.configure(text=number)

def resetMe():
    global number
    number = 0
    lbl1.configure(text=0)

#create gui controls
btn1 = ttk.Button(win , text="Click Me!" , command=clickMe)
btnReset = ttk.Button(win , text="Reset It" , command=resetMe)
lbl1 = ttk.Label(win , text=0)

# setting controls
btn1.grid(column=0 ,row=0)
btnReset.grid(column=1 ,row=0)
lbl1.grid(column=0 ,row=1)

win.mainloop()
