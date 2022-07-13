from tkinter import *
import datetime
import time
import winsound
from playsound import playsound

def Play():
	for i in range(10):
	    for i in range(4):
	        time.sleep(0.5)
	        print("\a")
	    time.sleep(3)



clock = Tk()
clock.title("Clock")
clock.geometry("400x200")

# The Variables we require to set the alarm(initialization):
hour = StringVar()
min = StringVar()
date = StringVar()
now = StringVar()


#Time required to set the alarm clock:
#hourTime= Label(clock,textvariable = date,width = 15, borderwidth=0).grid(padx=1,row=0, column=0)
minTime= Label(clock,textvariable = min,width = 15, borderwidth=0).grid(padx=1,row=0, column=1)
secTime = Label(clock,textvariable = now,width = 15, borderwidth=0, font="Arial 40").grid(padx=1,row=2, column=1)
#To take the time input by user:

#submit = Button(clock,text = "update time",fg="red",width = 10).grid(pady=50,row=3, column=1)


while 1:
        h = int(datetime.datetime.now().strftime("%H"))
        h = h if h<=12 else h - 12
        now.set("{}:{}".format(h, datetime.datetime.now().strftime("%M:%S")))
        date.set(datetime.datetime.now().strftime("%d %m %Y"))
        #print(now.get()+" "+date.get(), end="\r")
        time.sleep(1)
        clock.update()
clock.mainloop()


