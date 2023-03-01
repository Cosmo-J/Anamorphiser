from time import gmtime, strftime

curtime = str(strftime("%d_%H_%M_%S", gmtime()))

print(curtime)
