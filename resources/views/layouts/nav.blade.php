<base href="{{ url('/') }}/">
<style>

    header .logo {
      font-size: 24px;
      font-weight: bold;
      
    }
    .header {
      background:linear-gradient(45deg, #2f87a2 0, #2f87a2 100%);
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .header  img {
      width: 200px;
      height: auto;
    }

 


</style>





  <nav class="navbar navbar-expand-lg navbar-light  header">
  <a class="navbar-brand" href="#">
     <img src="images/logo.png"  class="img-fluid" alt="الشعار">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  
  <div>
  </div>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-white" href="/"> الرئيسية </a>
      </li>


        @auth
    @if (auth()->user()->usertype >= 1)
        <li class="nav-item"><a href="{{ url('dashboard') }}" class="nav-link text-white">لوحة التحكم</a></li>
    @endif
    @endauth

    @auth
    @if (auth()->user()->usertype >= 2)
        <li class="nav-item"><a href="{{ url('users') }}" class="nav-link text-white">إدارة المستخدمين</a></li>
        <li class="nav-item"><a href="{{ url('register') }}" class="nav-link text-white"> إضافة مستخدم</a> </li>
        @endif
    @endauth
      
        <li class="nav-item"><a href="{{ url('user/profile') }}" class="nav-link text-white">إدارة الحساب</a></li>


      

 



      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn-danger btn">تسجيل الخروج</button>
</form>  
      </li>


      
    </ul>

  </div>
 
</nav>

