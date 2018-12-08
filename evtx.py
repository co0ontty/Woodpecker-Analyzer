#coding:utf-8
import mmap
import contextlib
import Tkinter
import tkMessageBox

from Evtx.Evtx import FileHeader
from Evtx.Views import evtx_file_xml_view


output = open("1.txt","r")
phonenumber = output.readlines()
output.close()
output = open("1.txt","w")
count = 1
EvtxPath = "security.evtx" 
with open(EvtxPath,'r') as f:
    with contextlib.closing(mmap.mmap(f.fileno(),0,access=mmap.ACCESS_READ)) as buf:
        fh = FileHeader(buf,0)
        print "正在统计请稍等......"
        for xml, record in evtx_file_xml_view(fh):
            count = count+1 
            # print count
            # file.write(xml)
        # print ""
        # print count
# output.close()
print count
print phonenumber[0]
output.write(str(count))
output.close()
if count > phonenumber:
    print "正常"
else:
    def show():
        tkMessageBox.showinfo(title='日志更改提醒', message='日志更改')
    show()