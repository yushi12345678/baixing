window.onload=function(){
		 alert(1);
	   var url = location.search; //获取url中"?"符后的字串  
	   var theRequest = new Object();  
	   if (url.indexOf("?") != -1) {  
	      var str = url.substr(1);  
	      strs = str.split("&");  
	      for(var i = 0; i < strs.length; i ++) {  
	         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);  
	      }  
	   };
	   alert(1);
	   alert(theRequest);
	// document.getElementById('header').addEventListener('click',Header);
	// function Header(){
	// 	var name="name"+name;
	// 	var xhr = new XMLHttpRequest();
	// 	xhr.open("GET","",true);
	// 	xhr.onload = function() {
	// 		console.log(this.responseText);
	// 	}
	// 	xhr.send();

	// }
	 
}