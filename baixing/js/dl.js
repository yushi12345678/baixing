window.onload=function(){
	
	document.getElementById('Todl').addEventListener('submit',Todl);
	function Todl(e){
			e.preventDefault();
			var name=document.getElementById('name').value;
			var pwd=document.getElementById('inputPassword').value;
			var params=new Array();
			params[0]=name;
			params[1]=pwd;
			var data = JSON.stringify(params);
			var x=new XMLHttpRequest();
			x.open('POST',"./admin/login/login.php",true);
			//设置请求头
			x.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			x.onload=function(){
				console.log(this.responseText);
				if(this.responseText=="true")
				{
					if(name=="admin")
					{
						alert('登陆成功');
						window.location.href="./admin.html";
					}else{
						window.location.href="./index.html";
					}
					
				}
				else
				{
					alert('用户名或密码错误，请重新输入');
				}
			}
			x.send("data="+data);

		}
	}
