function imgPreview(fileDom,img){
        var img = img;
        var result;
        //判断是否支持FileReader
        // if (window.FileReader) {
            var reader = new FileReader();
        // } else {
        //     alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
        // }

        //获取文件
        var file =fileDom.files[0];
        var imageType = /^image\//;
        //是否是图片
        if (!imageType.test(file.type)) {
            alert("请选择图片！");
            return;
        }
        // 读取完成
        reader.onload = function(e) {
            //获取图片dom

            //图片路径设置为读取的图片
            img.src = e.target.result;
            img.value='';
            result = e.target.result;

            // console.log(e.target.result);
        };


        reader.readAsDataURL(file);
        alert("图片上传成功");
        return result;

    }


function img1(fileDom){
    var fileDom = fileDom;
    var img= document.getElementById('preview');
    var logo = imgPreview(fileDom,img);
    sessionStorage.setItem('img_logo', logo);
    var data = sessionStorage.getItem('img_logo');
    // alert(data);
}
function img2(fileDom){
    var fileDom = fileDom;
    var img = document.getElementById('preview1');
    var logo = imgPreview(fileDom,img);
    sessionStorage.setItem('img_zhizhao', logo);
 }
function img3(fileDom){
    var fileDom = fileDom;
    var img = document.getElementById('preview2');
    var logo = imgPreview(fileDom,img);
    sessionStorage.setItem('img_zhengshu', logo);
 }
function img4(fileDom){
    var fileDom = fileDom;
    var img = document.getElementById('preview3');
    var logo = imgPreview(fileDom,img);
    sessionStorage.setItem('img_gongsi', logo);
}
function img5(fileDom){
    var fileDom = fileDom;
    var img = document.getElementById('preview4');
    var logo = imgPreview(fileDom,img);
    sessionStorage.setItem('img_jiangxiang', logo);
 }
// document.getElementById('clk').addEventListener('click',submit(),false);
function submit(){
    var logo = sessionStorage.getItem('img_logo');
    var name=document.getElementById('company').value;
    var s = document.getElementsByName("chkStudent");
    var s2 = "";
    for( var i = 0; i < s.length; i++ )
    {
    if ( s[i].checked ){
    s2 += s[i].value+'','';
    }
    }
    s2 = s2.substr(0,s2.length-1);
    // console.log(s2);
    var BusinessLicense = sessionStorage.getItem('img_zhizhao');
    var BusinessCertificate = sessionStorage.getItem('img_zhengshu');
    var LicensingCompany = sessionStorage.getItem('img_gongsi');
    var Awards = sessionStorage.getItem('img_jiangxiang');
    var jianjie=document.getElementById('comment').value;
    var address=document.getElementById('address').value;
    var phone=document.getElementById('phone').value;
    var params=new Array();
    params[0]=logo;
    params[1]=name;
    params[2]=s2;
    params[3]=BusinessLicense;
    params[4]=BusinessCertificate;
    params[5]=LicensingCompany;
    params[6]=Awards;
    params[7]=jianjie
    params[8]=address;
    params[9]=phone;
    var data = JSON.stringify(params);
    var xhr = new XMLHttpRequest;
        xhr.open('post', './admin/sj_details/sj_details.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("data=" + data);//  Content-Type设置成application/x-www-form-urlencoded 的情况下，请求主体可以用key1=value1&key2=value2的形式发送数据
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304))  //响应完成并且响应码为200或304
          alert(xhr.responseText);
}
}