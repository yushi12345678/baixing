window.onload=function(){
	// document.getElementById('company-list').addEventListener('submit',CompanyList)
	function getUrlParam(name) {
		var url = window.location.search;// 正则筛选地址栏
		var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");// 匹配目标参数
		var result = url.substr(1).match(reg);//返回参数值
		return result ? decodeURIComponent(result[2]) : null;
	}
	var name = getUrlParam('fw');
	var x=new XMLHttpRequest();
	x.open('POST',"./admin/sj_select/sj_select.php",true);
	//设置请求头
	x.setRequestHeader('Content-type','application/x-www-form-urlencoded'); 
	x.onload=function(){
		var str=this.responseText;
		str = unescape(str.replace(/\\u/g, "%u")); 
		document.getElementById("header").innerHTML = name+'服务';
		var obj = JSON.parse(str);
		var outputs = '';
		for(var i in obj){
			outputs +=`
				<div class="company-list" id="company-list">
					<a href="./gsjj.html">
						<div class="detial">
							<div class="detial-img">
								<img src="${obj[i].sj_img}">
							</div>
							<div class="detial-font">
								<p style="font-size:0.8rem;color:#ff5555;display: block;margin-bottom: 0.3rem;margin-top:0.2rem">${obj[i].sj_mc}</p>
								<p style="width:100%;font-size:0.6rem;color:#aaa;display: block;margin-bottom: 0.2rem;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${obj[i].sj_jj}</p>
								<p style="font-size:0.7rem;color:#0c8484;display: block;">直线距离<span>${obj[i].sj_jl}</span>m</p>
							</div>
						</div>
					</a>
				</div>
			`
		}
		document.getElementById('company-list').innerHTML = outputs;
	}
	x.send("fuwu="+name);
}