import os
import shutil
outputPath = os.getcwd()+'/output.mp4'
backPath = "../"
shutil.move(os.getcwd()+'/output.mp4', "../")
