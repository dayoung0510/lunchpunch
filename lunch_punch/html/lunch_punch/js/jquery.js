

////////////// 룰렛 관련 코드 ///////////////

var _today = new Date();

//문서 시작할 때 룰렛 셋팅
$(document).ready(function(){
  rouletteSetting();
  let theWheel;



  });





  function rouletteSetting(){

  theWheel = new Winwheel({

  'numSegments' : menusForGame.length,
  'outerRadius' : 112,
  'textFontSize' : 14,
  'segments' : addTowheel(),
  'animation' :
  {
  'type' : 'spinToStop',
  'duration' : 1, // 지속시간(초)
  'spins' : 8, // 회전 수
  'callbackFinished' : alertPrize //결과로 실행될 함수
  }
  });

  }



  
//룰렛 안 컬러 설정
var colorArray = [];


    for(var i=0; i<30; i++){

      // colorArray.push('#' + Math.round(Math.random()*0xffffff).toString(16));

      //i나누기3의 나머지가 0일 때
      if(i%4 === 0){
        colorArray.push('#a4dcf5');
      }

      //i나누기3의 나머지가 1일 때
      else if(i%4 === 1){
        colorArray.push('#2d2d2d');
      }

      else if(i%4 === 2){
        colorArray.push('#9b72ca');  
      } 

      else if(i%4 === 3){
        colorArray.push('#7dba9e'); 
      }
      
    }






    //체크박스에 선택된 항목들이 menusForGame이라는 array 안으로 들어감 -> 이 array를 휠 안으로 넣는 로직
    //컬러값도 함께 설정해주어야 하니까, 컬러값+메뉴명을 json으로 만들어서 넣는다
  function addTowheel(){

    ar = new Array();

    for (var i=0; i<menusForGame.length; i++){
      json = new Object();
      // json.fillStyle = '#' + Math.round(Math.random()*0xffffff).toString(16);
      json.fillStyle = colorArray[i];
      json.text = menusForGame[i];

      ar.push(json);
    }
    return ar
}



  // Vars used by the code in this page to do power controls.
  let wheelPower = 0;
  let wheelSpinning = false;


 
  function startSpin()
  {

    //0일 때 돌리려고 시도하면 룰렛에서 에러나더라
    if(menusForGame.length !== 0){

      if (wheelSpinning == false) {

        theWheel.startAnimation();

        //결과 나올 때까지 시작버튼 눌러도 더 안돌아가게
        wheelSpinning = true;
      }
    }

    else{
      alert("항목을 선택하세요.");
    }

  }

  function resetWheel()
  {
      theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
      theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
      theWheel.draw();                // Call draw to render changes to the wheel.

      wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
  }

  var resultText;

  function alertPrize(indicatedSegment)
  {
    resultText = indicatedSegment.text;

    $('#howAbout').append("오늘 점심은 '" +resultText+ "' 어떠세요?");
    showModal();

    //휠을 다시 돌릴 수 있게 false로 설정
    wheelSpinning = false;
  }

  var todayMenus = [];
  
  function sayYes() {
    hideModal();
    // wheelSpinning = true;

    // 저장로직 실행
    var HISTORY_LS = "todayHistory"
    // var _today = new Date();
    var formatToday = _today.format('MM월 dd일 (KS)');


    var loadedHistory = localStorage.getItem(HISTORY_LS);

    var todayMenusObj = {
      id: _today.format('yyMMdd'),
      date: formatToday,
      name: resultText
    }


    var parsedHistory = JSON.parse(loadedHistory);

    if(parsedHistory !== null){
      console.log("마지막날짜: ", parsedHistory[0].id);
    }




    //이거 안하면 로컬스토리지에 첫 번째 값이 null로 들어가더라
    if (loadedHistory !== null) {
      todayMenus = [];


      console.log(parsedHistory.length)

      for (var i = 0; i < parsedHistory.length; i++) {

        var historyObj = {
          id: parsedHistory[i].id,
          date: parsedHistory[i].date,
          name: parsedHistory[i].name
        }

        todayMenus.push(historyObj);
      }

    }

    todayMenus.unshift(todayMenusObj);
    localStorage.setItem(HISTORY_LS, JSON.stringify(todayMenus));
    $('#howAbout').empty();
    $('.history-ul').empty();
    loadHistory();

  }



  //버튼 클릭 막는 함수
  function blockButton(){
    $('#spin_button').attr('disabled', true);
    $('#spin_button').empty();
    $('#spin_button').text('오늘 게임 끝');
    $('#spin_button').css('background-color', '#454545');
    $('#spin_button').css('color', '#fff');
    $('#spin_button').css('border', 'none');
  }

  function sayNo(){
    $('#howAbout').empty();
    hideModal();
    resetWheel();
  }

  
  function showModal(){
    $('#resultModal').addClass('show');
    $('#resultModal').removeClass('hide');
  }

  function hideModal(){
    $('#resultModal').addClass('hide');
    $('#resultModal').removeClass('show');
  }


  var addWord = $('#menu-input')

  //////////////////////// 룰렛 관련 코드 끝 /////////////////////



  //////////////////////// 날짜 관련 코드 /////////////////////

  


  Date.prototype.format = function (f) {

    if (!this.valueOf()) return " ";

    var weekKorName = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
    var weekKorShortName = ["일", "월", "화", "수", "목", "금", "토"];
    var weekEngName = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var weekEngShortName = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var d = this;



    return f.replace(/(yyyy|yy|MM|dd|KS|KL|ES|EL|HH|hh|mm|ss|a\/p)/gi, function ($1) {

        switch ($1) {
            case "yyyy": return d.getFullYear(); // 년 (4자리)
            case "yy": return (d.getFullYear() % 1000).zf(2); // 년 (2자리)
            case "MM": return (d.getMonth() + 1).zf(2); // 월 (2자리)
            case "dd": return d.getDate().zf(2); // 일 (2자리)
            case "KS": return weekKorShortName[d.getDay()]; // 요일 (짧은 한글)
            case "KL": return weekKorName[d.getDay()]; // 요일 (긴 한글)
            case "ES": return weekEngShortName[d.getDay()]; // 요일 (짧은 영어)
            case "EL": return weekEngName[d.getDay()]; // 요일 (긴 영어)
            case "HH": return d.getHours().zf(2); // 시간 (24시간 기준, 2자리)
            case "hh": return ((h = d.getHours() % 12) ? h : 12).zf(2); // 시간 (12시간 기준, 2자리)
            case "mm": return d.getMinutes().zf(2); // 분 (2자리)
            case "ss": return d.getSeconds().zf(2); // 초 (2자리)
            case "a/p": return d.getHours() < 12 ? "오전" : "오후"; // 오전/오후 구분

            default: return $1;

        }

    });

};



String.prototype.string = function (len) { var s = '', i = 0; while (i++ < len) { s += this; } return s; };
String.prototype.zf = function (len) { return "0".string(len - this.length) + this; };
Number.prototype.zf = function (len) { return this.toString().zf(len); };

