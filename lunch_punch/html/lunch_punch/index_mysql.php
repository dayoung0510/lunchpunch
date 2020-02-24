<?php

include('php/dbconfig.php');

?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Lunch Punch (mysql)</title>


  <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/site.css" rel="stylesheet">


  <link href="https://fonts.googleapis.com/css?family=Raleway:200,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- 기본 js -->
  <script type="text/javascript" src="js/jquery.js"></script>


  <!-- 룰렛 -->
  <script type="text/javascript" src="js/Winwheel.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>




</head>

<body id="page-top">


  <nav class="navbar custom-nav navbar-expand-lg justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link custom-link" href="#play">PLAY</a>
      </li>
      <li class="nav-item">
        <a class="nav-link custom-link" href="#edit">EDIT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link custom-link" href="#history">HISTORY</a>
      </li>
    </ul>
  </nav>


  <section id="play">
    <div class="container">

      <!-- 룰렛 -->
      <div class="row" style="height: 40%;">
        <div class="col-lg-12" style="height: 100%;">
          <div class="game-bg">

            <div style="height: 10%; display: flex; justify-content: center; align-items: center;">
              <button class="custom-btn" id="spin_button" onClick="startSpin();">START</button>
            </div>


            <div style="height: 90%; position: relative;">

                <!-- 룰렛 받침대 -->
                <img src="wheel_back.png" style="height: calc(100% - 10px); position: absolute; bottom: 10px; left: 50%; transform:translateX(-50%)">

                <!-- 룰렛 원판 -->
                <canvas id="canvas" width="280" height="280"
                  style="position: absolute; top: 9px; left: 50%; transform:translateX(-50%)"></canvas>

             </div>


                <!-- 모달 -->
                <div id="resultModal" class="my-modal hide">
                    <div class="modal-text">
                      <div id="howAbout"></div>
                      <div class="modal-btn">
                        <button class="custom-btn" onclick="sayYes();">OK</button>
                        <button class="custom-btn" onclick="sayNo();">RESTART</button>
                      </div>
                    </div>
                </div>



          </div>
        </div>
      </div>

      <!-- 카테고리 -->
      <div class="row padding-top-05 justify-content-center" style="height: 40%;">
        <div class="col-lg-12 flex-center" style="height:10%;">
          <div class="category-title">NEW</div>
          <div class="category-title">DAILY</div>
          <div class="category-title">SPECIAL</div>
        </div>

        <div class="col-lg-12 flex-center" style="height: 90%;">
          <div class="category">
            <ul class="category-ul" id="ul-new"></ul>
          </div>
          <div class="category">
            <ul class="category-ul" id="ul-daily"></ul>
          </div>
          <div class="category">
            <ul class="category-ul" id="ul-special"></ul>
          </div>
        </div>
      </div>

      <!-- 담은항목 -->
      <div class="row" style="height: 19%; padding: 0 1%;">
        <div class="col-lg-12 basket">
          <div style="height: 15%;">담은항목</div>
          <div class="basket-div">
            <ul class="basket-ul"></ul>
          </div>
        </div>
      </div>
    </div>
  </section>





  <section id="edit">
    <div class="container" style="position: relative;">

      <!-- 메뉴추가 -->
      <div class="row" style="height: 20%;">
        <div class="col-lg-12 add-menu">
          <div class="input-group-prepend">

            <form class="flex" method="post" action="php/menu_add.php">
              <!-- 드롭다운 -->
              <!-- <select id="drdown-category" class="btn btn-outline-lightgray dropdown-toggle">
                <option value="new">NEW</option>
                <option value="daily">DAILY</option>
                <option value="special">SPECIAL</option>
              </select> -->

              <input type="text" class="form-control" name="category">

              <!-- 입력창 -->
              <input type="text" class="form-control" name="name">

              <!-- 확인버튼 -->
              <div class="input-group-append">
                <button id="add-menu-btn" class="btn btn-lightgray btn-outline-secondary" type="submit">
                  <i class="fas fa-check"></i></button>
              </div>

            </form>

          </div>


        </div>
      </div>

      <!-- 카테고리 -->
      <div class="row" style="height: 80%;">
        <div class="col-lg-12 show-menu">
          <div class="flex-center">
            <div class="category-title">NEW</div>
            <div class="category-title">DAILY</div>
            <div class="category-title">SPECIAL</div>
          </div>

          <!-- 삭제모달 -->
          <div id="deleteModal" class="del-modal hide">
            <div class="modal-text">
              <div id="really"></div>
              <div class="modal-btn">
                <button class="custom-btn" id="delete-yes"> OK </button>
                <button class="custom-btn" id="delete-no"> CANCLE </button>
              </div>
            </div>
          </div>


        </div>


        <div class="col-lg-12 flex-center" style="height: 90%;">
          <div class="category">
            <ul class="category-ul" id="category-ul-new"></ul>
          </div>
          <div class="category">
            <ul class="category-ul" id="category-ul-daily"></ul>
          </div>
          <div class="category">
            <ul class="category-ul" id="category-ul-special"></ul>
          </div>
        </div>


      </div>
    </div>
  </section>






  <section id="history">
    <div class="container">
      <div class="row" style="height: 100%;">
        <div class="col-lg-12" style="height: 100%;">





          <div class="flex-end history-title" style="height: 15%;">HISTORY</div>
          <div class="history" style="height: 75%;">

            <ul class="history-ul">

            </ul>

          </div>


        </div>
      </div>
    </div>
  </section>






  <script>

    // var MENUS_LS = "menus";
    // var menus = [];




    // function saveMenus(){

    //   //로컬스토리지에 저장해주기
    //   localStorage.setItem(MENUS_LS, JSON.stringify(menus));
    // }


    // function paintMenus(parsedMenus){

    //   //1단, 3단 보이는 부분 지워주기
    //   $('.category-ul li').remove();
    //   menus = [];

    //   for(var i=0; i<parsedMenus.length; i++){

    //     var newId = i;

    //     if(parsedMenus[i].category === "new") {
    //     //PLAY 카테고리에 보여주기
    //     $("#ul-new").append("<li> <input type='checkbox' class='chk-menu' id=chk" + i + "> <span>" + parsedMenus[i].name + "</span> </li>");

    //     //EDIT 카테고리에 보여주기
    //     $("#category-ul-new").append("<li id=" + newId + ">" + "<span>" + parsedMenus[i].name + "</span>" + "<span class='del-span'>" +"<i class='fas fa-times del-icon'>");
    //     }

    //     else if(parsedMenus[i].category === "special") {
    //       $("#ul-special").append("<li> <input type='checkbox' class='chk-menu' id=chk" + i + "> <span>" + parsedMenus[i].name + "</span> </li>");
    //       $("#category-ul-special").append("<li id=" + newId + ">" + "<span>" + parsedMenus[i].name + "</span>" + "<span class='del-span'>" +"<i class='fas fa-times del-icon'>");
    //     }

    //     else{
    //       $("#ul-daily").append("<li> <input type='checkbox' class='chk-menu' id=chk" + i + "> <span>" + parsedMenus[i].name + "</span> </li>");
    //       $("#category-ul-daily").append("<li id=" + newId + ">" + "<span>" + parsedMenus[i].name + "</span>" + "<span class='del-span'>" +"<i class='fas fa-times del-icon'>");
    //     }

    //     //여태껏 로컬에 있던 것 불러와서 menus(배열)로 만듦 -이유는 새로 추가하는 메뉴가 뒤로 들어가는 게 아니라, 덮어씌워지기 때문
    //     var menuObj = {
    //       id : i,
    //       category : parsedMenus[i].category,
    //       name : parsedMenus[i].name
    //     };

    //     menus.push(menuObj);

    //     //로컬스토리지에 저장
    //     saveMenus();

    //   }

    // }


    // function addMenus(){

    //   var drdownCat = $('#drdown-category option:selected').val();
    //   var inputName = $('#menu-input').val();
    //   var addJsonMenu = new Object();

    //   //input박스에 내용이 비지 않았으면
    //   if(inputName != ''){
      
    //     //input에 입력한 걸 제이슨으로 만들기
    //     addJsonMenu.id = menus.length + 1;
    //     addJsonMenu.category = drdownCat;
    //     addJsonMenu.name = inputName;
        
    //     //위의 제이슨을 어레이에 새로 넣기
    //     menus.push(addJsonMenu);
    //     saveMenus();

    //   //인풋박스 초기화
    //   $('#menu-input').val('');


    //     init();
    //   }

    // }


    // function deleteMenus(){

    //   var thisId = $(this).closest("li").attr("id");
    //   var thisName = menus[thisId].name;

    //   menus.splice(thisId, 1);
    //   saveMenus();
    //   init();

    // }


    // function loadMenus(){

    //   //로컬스토리지에서 데이터 불러오기
    //   var loadedMenus = localStorage.getItem(MENUS_LS);

    //   //불러온 데이터가 빈값이 아니면
    //   if (loadedMenus !== null){
    //     //스트링 형태로 바꿔주고
    //     var parsedMenus = JSON.parse(loadedMenus);
    //     //화면에 뿌려주는 함수로 이동
    //     paintMenus(parsedMenus);
    //   }

    // }










// var menusForGame = [];

// function checkChange(){
//   //전체 체크박스 변화 감지
//   $('.chk-menu').change(function() {

//   //어레이 초기화
//   menusForGame = new Array();

//   //몇 번째 박스가 체크됐는지 확인
//   for(var k=0; k<menus.length; k++){ 
    
//     if($("#chk"+k).is(":checked")) { 

//     //체크된 박스를 menusForGame 어레이에 넣기
//     menusForGame.push(" " + menus[k].name + " "); 

//     //게임 룰렛에 항목 들어가게 하기
//     rouletteSetting();

//     }
// }

//   // 담은항목 li 초기화
//   $(" .basket-ul li").remove(); 
  
//   //어레이에 있는 것들을 li에 담아 보여주기 
//   $(".basket-ul").append("<li>"+ menusForGame +"</li>");


//   //메뉴들 넣었다가 뺐을 때 룰렛 초기화
//   if(menusForGame.length === 0){
//     console.log("룰렛비우기");
//     rouletteSetting();
//   }

//   });

// }





// // 히스토리
// function loadHistory(){

//   var historyDate;
//   var historyName;

//   var HistoryforText = localStorage.getItem("todayHistory");
//   var parsedHistoryforText = JSON.parse(HistoryforText);
  
//   //히스토리 보이는 부분 초기화
//   $('.history-ul').empty();

//   if(HistoryforText !==null){
//     for(var i=0; i<parsedHistoryforText.length; i++){

//       historyDate = parsedHistoryforText[i].date;
//       historyName = parsedHistoryforText[i].name;

//       $(".history-ul").append('<li><span class="date">' + historyDate + '</span>' + '<span class="history-menu">' + historyName + '</span></li>');

//     }

//     //게임 하루에 한 번만 하게 설정
//     var a = _today.format('yyMMdd');
//     var b = parsedHistoryforText[0].id;

//     if(a === b){
//       blockButton();
//     }

//   }


// }








// function init(){
//       loadMenus();
//       $('#add-menu-btn').click(addMenus)
//       $('.del-icon').click(deleteMenus);
//       loadHistory();
//       checkChange();
//     }

//     init();



    //페이지 부드럽게 이동
    $("a[href^='#']").click(function(event){
      event.preventDefault();
      var target = $(this.hash);
      $('html, body').animate({scrollTop: target.offset().top}, 400);
    });

</script>









  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>





</body>

</html>