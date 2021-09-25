
/* Description: Custom JS file */


(function($) {
    "use strict"; 

    /* Navbar Scripts */
    // jQuery to collapse the navbar on scroll
    $(window).on('scroll load', function() {
		if ($(".navbar").offset().top > 60) {
			$(".fixed-top").addClass("top-nav-collapse");
		} else {
			$(".fixed-top").removeClass("top-nav-collapse");
		}
    });
    
	// jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function() {
		$(document).on('click', 'a.page-scroll', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 600, 'easeInOutExpo');
			event.preventDefault();
		});
    });

    // offcanvas script from Bootstrap + added element to close menu on click in small viewport
    $('[data-toggle="offcanvas"], .navbar-nav li a:not(.dropdown-toggle').on('click', function () {
        $('.offcanvas-collapse').toggleClass('open')
    })

    // hover in desktop mode
    function toggleDropdown (e) {
        const _d = $(e.target).closest('.dropdown'),
            _m = $('.dropdown-menu', _d);
        setTimeout(function(){
            const shouldOpen = e.type !== 'click' && _d.is(':hover');
            _m.toggleClass('show', shouldOpen);
            _d.toggleClass('show', shouldOpen);
            $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
        }, e.type === 'mouseleave' ? 300 : 0);
    }
    $('body')
    .on('mouseenter mouseleave','.dropdown',toggleDropdown)
    .on('click', '.dropdown-menu a', toggleDropdown);


    /* Rotating Text - Morphtext */
	$("#js-rotating").Morphext({
		// The [in] animation type. Refer to Animate.css for a list of available animations.
		animation: "fadeIn",
		// An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
		separator: ",",
		// The delay between the changing of each phrase in milliseconds.
		speed: 2000,
		complete: function () {
			// Called after the entrance animation is executed.
		}
    });

    
    /* Move Form Fields Label When User Types */
    // for input and textarea fields
    $("input, textarea").keyup(function(){
		if ($(this).val() != '') {
			$(this).addClass('notEmpty');
		} else {
			$(this).removeClass('notEmpty');
		}
	});
	

    /* Back To Top Button */
    // create the back to top button
    $('body').prepend('<a href="body" class="back-to-top page-scroll">Back to Top</a>');
    var amountScrolled = 700;
    $(window).scroll(function() {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('500');
        } else {
            $('a.back-to-top').fadeOut('500');
        }
    });


	/* Removes Long Focus On Buttons */
	$(".button, a, button").mouseup(function() {
		$(this).blur();
	});

    /*Send Message to WhatsApp*/
    const uri='https://message.confesta.com.br/api/'
    const token= '$2b$10$tBSp.BGjaQhzh7ACXgh7luW_SC2dEC2hmpuOCOpyaZumZbxr20BPm'
    const session= 'messagesite/'
    const  point='send-message'
    const btnSend = document.querySelector("#btnSend")
    const name = document.querySelector("#cname")
    const phone = document.querySelector("#cphone")
    const cmessage = document.querySelector("#cmessage")
    const url = `${uri}${session}${point}`
    const message = `*Messagem da Landing Page* Olá meu nome é ${name.value} e meu número é ${phone.value} visitei seu site e desejo o seguinte: ${cmessage.value}`
    const body = {
        "phone": "5586988698580",
        "message": message,
        "isGroup": false
      }
      const confirme = document.querySelector("#resposta")
    btnSend.addEventListener("click", event=>{
        event.preventDefault()
        if(name.value && phone.value && cmessage.value){
            document.getElementById("btnSend").innerHTML = "Aguarde..."
            fetch(url,{
                method:'POST',
                headers:{
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${token}`
                   },
                   body:JSON.stringify(body)
                }).then(response =>{
                    return response.json()
                }).then(data=>{
                    document.getElementById("btnSend").innerHTML = "Enviar"
                    confirme.setAttribute("class","alert alert-success")
                    confirme.innerHTML = `Obrigado pela mensagem ${name.value}! Em breve entraremos em contato!`
                    confirme.setAttribute("style","display:block")
                })
                
        }else{
            confirme.setAttribute("class","alert alert-danger")
            if(!name.value){
                confirme.innerHTML = "Por favor, informe seu nome!"
            }else if(!phone.value){
                confirme.innerHTML = "Por favor, informe seu telefone!"
            }else if(!cmessage.value){
                confirme.innerHTML = "Por favor, preencha o campo mensagem!"
            }
            confirme.setAttribute("style","display:block")
        }

        })

        function setVisibilityButton(value){
            btnSend.setAttribute("disabled",value)
        }

})(jQuery);