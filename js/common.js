function slideImg() {

    //객체변수 선언
    let slideBox = document.querySelector("div.slideBox");
    let slide_image_box=document.querySelector("div.slide_image_box");
    let slides=document.querySelectorAll("div.slide_image_box a");
    let prev=document.querySelector("div.slide_nav a.prev");
    let next=document.querySelector("div.slide_nav a.next");

    let slideCount = slides.length;
    let currentIndex = 0; // 슬라이드 현재 위치
    let timer ; //timer 설정 변수

    //슬라이드를 가로로 배열해서 배치한다. 

    for(let i=0; i<slideCount; i++){
        let newLeft = i*100 + '%'
        slides[i].style.left = newLeft;
    }
    

    slide_image_box.classList.add('animated');
    console.log(slide_image_box);

    //슬라이드를 이동시켜보자
    function gotoSlide(index){
        currentIndex = index;
        let newLeft = -(currentIndex*100) + '%';
        slide_image_box.style.left = newLeft;
        slide_image_box.classList.add('animated');
        //0번이면 왼쪽 네비게이션 바를 안보이게 하고 7번이면 오른쪽 네비게이션 바를 안보이게 함

        (currentIndex === 0)?(prev.classList.add('disabled')):(prev.classList.remove('disabled'));
        (currentIndex === 11)?(next.classList.add('disabled')):(next.classList.remove('disabled'));
    }


    //슬라이드 초기화 위치
    gotoSlide(0);

    //좌우 네비게이션 바 이벤트 핸들러 처리
    prev.addEventListener('click', function(e){
        e.preventDefault(); //angker 기능을 막아버린다.
        let index = currentIndex;
        index=(index ===0) ? slideCount -1 : index -1; 

        gotoSlide(index);
    });

    next.addEventListener('click', function(e){
        e.preventDefault(); //angker 기능을 막아버린다.
        let index = currentIndex;
        index=(index === (slideCount-1)) ? 0 : index +1; 
        
        gotoSlide(index);
    });

    function startTimer() {
        timer = setInterval(function(){
            let index = (currentIndex+1) % slideCount;
            gotoSlide(index);
        }, 3000);
    }
    startTimer();

    console.log(timer);

    //자동타이머를 정지시키는 세팅
    slide_image_box.addEventListener('mouseenter', function(){
        clearInterval(timer);
    });

    slide_image_box.addEventListener('mouseleave', function(){
        clearInterval(timer);
    });

}//end of slide func

function prevOnclick(){
    console.log("prevEvent")
}
