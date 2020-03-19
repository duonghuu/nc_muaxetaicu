<script language="javascript">
function js_lost_pw(){
	window.location = '<?=@$lost_password_url?>';
}
</script>




<div id="login">
 
  <form action="index.php?com=user&act=login" method="post" id="login">
	<h3>Đăng nhập quản trị web</h3>
    <input type="text" name="username" class="big" placeholder="Tên đăng nhập" />
    <input type="password" name="password" class="big" placeholder="Password" />
    <input type="submit" value="Log in" class="big" />
  </form>
</div>


<style>
body{
  background:#567;
  font-family:'Open Sans',sans-serif;
}

.button{
  width:100px;
  background:#3399cc;
  display:block;
  margin:0 auto;
  margin-top:1%;
  padding:10px;
  text-align:center;
  text-decoration:none;
  color:#fff;
  cursor:pointer;
  transition:background .3s;
  -webkit-transition:background .3s;
}

.button:hover{
  background:#2288bb;
}

#login{
	
  width:400px;
  margin:0 auto;
  margin-top:8px;
  border-radius:5px;
  margin-top:150px;
  margin-bottom:2%;
  transition:opacity 1s;
  -webkit-transition:opacity 1s;
  padding-top:0;
  padding-bottom:10%;
 
}

#triangle{
  width:0;
  border-top:12x solid transparent;
  border-right:12px solid transparent;
  border-bottom:12px solid #3399cc;
  border-left:12px solid transparent;
  margin:0 auto;
}

#login h3{

  padding:20px 0;
  font-size:140%;
  font-weight:300;
  text-align:center;
  color:#fff;
  font-weight:bold;
  font-style:normal  !important;
  font-size:24px;
  color:#777;
  margin-top:0;
  text-transform:uppercase;
}

form{
  background:#f0f0f0;
  padding:6% 4%;
}

input[type="text"],input[type="password"]{
width: 100%;
background: #fff;
margin-bottom: 4%;
border: 1px solid #ccc;
padding: 4%;
font-family: 'Open Sans',sans-serif;
font-size: 100%;
color: #555;
font-size: 20px;
}

input[type="submit"]{
  width:100%;
  background:#3399cc;
  border:0;
  padding:4%;
  font-family:'Open Sans',sans-serif;
  font-size:100%;
  color:#fff;
  cursor:pointer;
  transition:background .3s;
  -webkit-transition:background .3s;
  font-size:20px;
}

input[type="submit"]:hover{
  background:#2288bb;
}

</style>