"use strict";

// Class definition
var KTAppChat = function () {
	function AutoRefresh( t ) {
		setTimeout("location.reload(true);", t);
	}
	const siteUrl = $('meta[name="site-url"]').attr('content');
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
		var file_name = $('#fileid').prop('files')[0];

        if (input.value.length === 0 ) {
            document.getElementById('msg_errors').innerHTML="Please enter a message";
     		return false;
        }
		var formData = new FormData();

		formData.append('msg', input.value);
		formData.append('ticket_id', ticket_id.value);
		formData.append('file_name', file_name);
		
		setTimeout(function() {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url : siteUrl+"addReplySupportTickets",
				type : 'post',
				data : formData,
				dataType : 'json',
				contentType: false,
				processData: false,
				success : function(result){
					if(result == 1) {
						location.reload();
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
