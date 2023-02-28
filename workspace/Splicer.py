import cv2
import glob
import os.path
import errno
import time
import math
import sys
import colorama
import subprocess

colorama.init()

timesTaken = []
timeIts = 3
totalEstimate = 0

def MakeEstimate(totalIts):
    total = 0
    for i in timesTaken:
        total+=i 
    x = (total/len(timesTaken) * totalIts) - total
    if x >=3600:
        #format hours
        return str(round(x/3600,2)) + " hours"
    elif x >= 60:
        #format minutes
        return str(round(x/60,2)) + " minutes"
    elif x < 60:
        return str(round(x,2)) + " seconds"
    

# Print iterations progress
def printProgressBar (iteration, total, timeTaken, prefix = '', suffix = '', decimals = 1, length = 100, fill = '█', printEnd = "\r"):
    global timeIts
    global totalEstimate
    percent = ("{0:." + str(decimals) + "f}").format(100 * (iteration / float(total)))
    filledLength = int(length * iteration // total)
    bar = fill * filledLength + '-' * (length - filledLength)

    

    timesTaken.append(timeTaken)
    totalEstimate = MakeEstimate(total)
    estimate = totalEstimate

    print(f'\r{prefix} |{bar}| {percent}% {suffix}')
    print(f'\rTime remaining: {estimate}', end = "\033[A\r")
    #print(f'\nTime remaining: {estimate}', end = printEnd)
    # Print New Line on Complete
    if iteration == total: 
        print()




dir = '.'
files = glob.glob(os.path.join(dir, '*.mp4'))
fileName = ''
for i in files:
    fileName = os.path.basename(i)
    #creates directory for frames
    path = ("in_frames")
    try:
        os.makedirs(path)
    except OSError as e:
        if e.errno != errno.EEXIST:
            raise

    vidcap = cv2.VideoCapture(i)
    success,image = vidcap.read()
    numFrames = int(vidcap.get(cv2.CAP_PROP_FRAME_COUNT))
    count = 0
    success = True
    print("CTRL + C to cancel")
    printProgressBar(0, numFrames, 0, prefix = 'Progress:', suffix = 'Complete', length = 50)
    while success:
        start = time.time()
        success,image = vidcap.read()
        if success == False:
            break
        cv2.imwrite(os.path.join(path, "frame%d.jpg" % count), image)     # save frame as JPEG
       # if cv2.waitKey(10) == 27:                     # exit if Escape is
       #     break
        
        count += 1
        end = time.time()
        printProgressBar(count + 1, numFrames, end-start, prefix = 'Progress:', suffix = 'Complete', length = 50)

os.system('anamorph_movie.exe')

#combines images back into movie
image_folder = 'out_frames'
video_name = fileName + 'Anamorphised.mp4'

images = [img for img in os.listdir(image_folder) if img.endswith(".jpg")]
frame = cv2.imread(os.path.join(image_folder, images[0]))
height, width, layers = frame.shape

video = cv2.VideoWriter(video_name, 0, 24, (width,height))

for image in images:
    video.write(cv2.imread(os.path.join(image_folder, image)))

cv2.destroyAllWindows()
video.release()



