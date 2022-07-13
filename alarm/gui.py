import tkinter as tk
from sklearn import datasets

from sklearn import svm
from sklearn import cluster, datasets

iris = datasets.load_iris()
clf = svm.LinearSVC()
# learn from the data
clf.fit(iris.data, iris.target)
# predict for unseen data
clf.predict([[ 5.0,  3.6,  1.3,  0.25]])
# Parameters of model can be changed by using the attributes ending with an underscore


# create clusters for k=3
k=3
k_means = cluster.KMeans(k)
# fit data
k_means.fit(iris.data)


window = tk.Tk()

message = iris.data.shape
text_box = tk.Text()
text_box.pack()
greeting = tk.Label(text=clf.coef_)
greeting.pack()
greeting = tk.Label(text=k_means.labels_[::10], font="Arial 20").pack()


#https://www.youtube.com/watch?v=1XTqE7LFQjI
#webcam
import cv2, time
video = cv2.VideoCapture(0)

a=0
while True:
	a=a+1
	check, frame = video.read()
	

	cv2.imshow("Capturing",frame)
	key = cv2.waitKey(1)
	if key == ord('q'):
		break
	print(frame)


video.release()
cv2.destroyAllWindows
window.mainloop()