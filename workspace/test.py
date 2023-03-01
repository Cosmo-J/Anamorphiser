import os
os.system("ffmpeg -f image2 -r 60 -i out_frames/anamorp_frame%d.jpg -vcodec libx264 -crf 18  -pix_fmt yuv420p test.mp4")
