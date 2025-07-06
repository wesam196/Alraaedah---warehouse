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
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-white" href="/"> الرئيسية </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="/dashboard">لوحة التحكم</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#">المستخدمين</a>
      </li>
      
    </ul>
  </div>
</nav>