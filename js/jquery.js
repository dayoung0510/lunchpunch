

////////////// 룰렛 관련 코드 ///////////////

//문서 시작할 때 룰렛 셋팅
$(document).ready(function(){
  rouletteSetting();
  let theWheel;

  })




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
      if (wheelSpinning == false) {

          theWheel.startAnimation();

          //결과 나올 때까지 시작버튼 눌러도 더 안돌아가게
          wheelSpinning = true;
      }
  }

  function resetWheel()
  {
      theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
      theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
      theWheel.draw();                // Call draw to render changes to the wheel.

      wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
  }


  function alertPrize(indicatedSegment)
  {
    var decoText = indicatedSegment.text;

    $('#howAbout').append("오늘 점심은 '" +decoText+ "' 어떠세요?");
    showModal();

    //휠을 다시 돌릴 수 있게 false로 설정
    wheelSpinning = false;
  }


  function sayYes(){
    hideModal();
    // wheelSpinning = true;
    $('#spin_button').attr('disabled', true);
    $('#spin_button').empty();
    $('#spin_button').text('오늘 게임 끝');
    $('#spin_button').css('background-color', '#454545');
    $('#spin_button').css('color', '#fff');
    $('#spin_button').css('border', 'none');
    console.log('저장로직 실행');
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

  //////////////////////// 룰렛 관련 코드 끝 //////////////