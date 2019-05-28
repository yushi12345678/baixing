window.onload=function(){
	document.getElementById('clk').addEventListener('submit',post_json,false);
	function post_json() {
        //Javascript以ajax发送数据JSON数据，PHP接收JSON前端
        var coy=document.getElementById('company').value;
	    var ads=document.getElementById('address').value;
	
        var arr = {
            "name": coy,
            "place": ads
        };
        var json = JSON.stringify(arr);//使用JSON将对象转换成JSON格式数据
        var xhr = new XMLHttpRequest;
        xhr.open('post', './admin/address1/text.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("user=" + json);//  Content-Type设置成application/x-www-form-urlencoded 的情况下，请求主体可以用key1=value1&key2=value2的形式发送数据
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304))  //响应完成并且响应码为200或304
                alert(xhr.responseText);
        }
    }

}