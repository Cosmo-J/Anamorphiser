import shutil
import os
#os.remove("../output.mp4")
os.system("ffmpeg -f image2 -r 24 -i out_frames/anamorp_frame%d.jpg -vcodec libx264 -crf 18  -pix_fmt yuv420p test.mp4")
#os.system("ffmpeg -f image2 -i out_frames/anamorp_frame%d.jpg -vcodec mpeg4 -framrate 24 output.avi")
shutil.move(os.getcwd()+'/output.avi', "../")
