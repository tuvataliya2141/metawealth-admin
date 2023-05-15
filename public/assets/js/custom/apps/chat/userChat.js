"use strict";

// Class definition
var KTAppChat = function () {

	const siteUrl = $('meta[name="site-url"]').attr('content');
	$(document).ready(function(){
		$(window).scrollTop(0);
	});
	// Private functions
	var handeSend = function (element) {
		if (!element) {
			return;
		}

		// Handle send
		KTUtil.on(element, '[data-kt-element="input"]', 'keydown', function(e) {
			$('#msg_errors').text('');
			if (e.keyCode == 13) {
				handeMessaging(element);
				e.preventDefault();
				return false;
			}
		});

		KTUtil.on(element, '[data-kt-element="send"]', 'click', function(e) {
			handeMessaging(element);
		});
	}

	var handeMessaging = function(element) {
		var messages = element.querySelector('[data-kt-element="messages"]');
		var input = element.querySelector('[data-kt-element="input"]');
		var ticket_id = element.querySelector('[data-kt-element="ticket_id"]');

        if (input.value.length === 0 ) {
            document.getElementById('msg_errors').innerHTML="Please enter a message";
     		return false;
        }
		const data = {
			msg: input.value,
			ticket_id: ticket_id.value,
		};

		setTimeout(function() {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : siteUrl+"replySupportTickets",
				type : 'post',
				data : data,
				dataType : 'json',
				success : function(result){
					if(result == 1) {
						location.reload();
						var el = document.querySelector('#kt_chat_messenger_body');
						el.scrollBottom = el.scrollHeight;
					}     
				}
			});
		}, 2000); 

		// var messageOutTemplate = messages.querySelector('[data-kt-element="template-out"]');
		// var messageInTemplate = messages.querySelector('[data-kt-element="template-in"]');
		// var message;
		
		// // Show example outgoing message
		// // message = messageOutTemplate.cloneNode(true);
		// // message.classList.remove('d-none');
		// message.querySelector('[data-kt-element="message-text"]').innerText = input.value;		
		// input.value = '';
		// messages.appendChild(message);
		// messages.scrollTop = messages.scrollHeight;
		
		
		// setTimeout(function() {			
		// 	// Show example incoming message
		// 	message = messageInTemplate.cloneNode(true);			
		// 	message.classList.remove('d-none');
		// 	message.querySelector('[data-kt-element="message-text"]').innerText = 'Thank you for your awesome support!';
		// 	messages.appendChild(message);
		// 	messages.scrollTop = messages.scrollHeight;
		// }, 2000);
	}

	// Public methods
	return {
		init: function(element) {
			handeSend(element);
        }
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	// Init inline chat messenger
    KTAppChat.init(document.querySelector('#kt_chat_messenger'));

	// Init drawer chat messenger
	KTAppChat.init(document.querySelector('#kt_drawer_chat_messenger'));
});
