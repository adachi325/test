/* --------------------------------------------- */
/* 指定画像印刷用 javascript */  
/* --------------------------------------------- */
_wopen=window.open
function wopen(url,name,opt){
var w,h,c=false,g=null,l,t,o,x=-1,i=0,a=["left","top","width","height","resizable","scrollbars","status","menubar","toolbar","location","directories"]
if(!name)name="";if(!opt)opt=""
if(opt.match(/^(\d+|\*)(,(\d+|\*))+$/)){
do opt=opt.substring(0,x+1)+a[i]+"="+opt.substring(x+1);while((x=opt.indexOf(',',x+a[i++].length))!=-1)
opt=opt.replace(/[^=]+=\*,/g,"")
}
if(opt.match(/image=(true|1)/)){
g=new Image();g.src=url;url="";opt+=",resizable=1"
if(g.width>0&&g.height>0)
opt+=",width="+(w=g.width)+",height="+(h=g.height)
}
if(
(w=opt.match(/width=(\d+)/))&&(w=RegExp.$1)&&
(h=opt.match(/height=(\d+)/))&&(h=RegExp.$1)&&
opt.match(/center=(true|1)/)&&!!(c=true)
)
opt+=",left="+(l=(screen.width-w)/2)+",top="+(t=(screen.height-h)/2)
o=_wopen(url,name,opt)
if(c&&navigator.platform.indexOf("Mac")!=-1)o.moveTo(l,t)
if(g){
o.document.open()
o.document.write(
'<html><head><title>'+g.src.substring(g.src.lastIndexOf('/')+1)+'</title><head><body style=overflow:hidden leftmargin=0 topmargin=0 marginwidth=0 marginheight=0><center><img src="'+g.src+'"'+(w>0&&h>0?' width='+w+' height='+h:
' onload="if(self.innerWidth){self.innerWidth=this.width;self.innerHeight=this.height}else{self.resizeBy(this.width-document.body.clientWidth,this.height-document.body.clientHeight)}"')+'></center></body></html>')
o.document.close()
}
return o
}
window.open=wopen

function newopen(imgname){
	pwin=window.open(imgname,'img1','left=100,top=100,image=1');
	pwin.print();
	pwin.close();
	return false;
}

