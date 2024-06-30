if( typeof jQuery == "function" ){
jQuery(document).ready(function($){

	var curX = 1;
	var curY = 1;
	var coord = ['a','b','c','d','e','f','g','h'];

	function getNextMove()
	{
		var data = {
			prevx		: curX,
			prevy		: curY,
			_ajax_nonce	: ajax_nonce
			}

	//	$('#dores').html( '' );
		$('#doajax').show();
		var myajax = jQuery.post(ajaxurl, data, function(response) {
			$("#doajax").hide();
			if( response != '-1' && ! response.err )
			{
				if( response.v )
					$('#dolog').html( response.v );

				if( response.msg == 'next' )
				{
					$(".prob").removeClass('prob');
					$("#col"+curX+''+curY).addClass('coldone').removeClass('curpos');
					$("#col"+response.next).addClass('curpos');

					curX = parseInt( response.next[0], 10 );
					curY = parseInt( response.next[1], 10 );

					$('#plann ol').append('<li>'+coord[(curX-1)]+''+curY+'</li>');
					$('#plann').animate({ scrollTop: $('#plann div').height() }, "slow");

					setTimeout( function() {nextMove();}, 1000 );
				}
				else if( response.msg == 'done' )
				{
					$(".prob").removeClass('prob');
					$("#col"+curX+''+curY).addClass('coldone');

					$('#plann ol').append('<li>All Done!<br/><a href="javascript:location.reload()">Start Over >>></a></li>');
					$('#plann').animate({ scrollTop: $('#plann div').height() }, "slow");
					started = 0;
				}
				else if( response.msg == 'stale' )
				{
					$(".prob").removeClass('prob');
					$("#col"+curX+''+curY).addClass('coldone');

					$('#plann ol').append('<li>yep, the horse is moody</li>');
					$('#plann').animate({ scrollTop: $('#plann div').height() }, "slow");

					$("#col11").addClass('curpos');
					started = 0;
				}
			}
			else
			{
				$('#dores').html('Error: <!-- code: '+response.err+' -->'+ response.msg );
			}
		}, "json");
		$(window).unload( function() { myajax.abort(); } );
	}

	function nextMove()
	{
		moves = [[2,1],[1,2],[-1,2],[-2,1],[-2,-1],[-1,-2],[1,-2],[2,-1]];

		$.each( moves, function( i, j ){
			a = curX + j[0];
			b = curY + j[1];
			$("#col"+a+''+b).addClass('prob');
		});

		setTimeout( function() {getNextMove();}, 500 );
	}

	started = 0;
	$("#start").click( function(){
		if( started == 0 )
		{
			nextMove();
			started = 1;
		}
	});

	setTimeout( function() {if( started == 0 ){nextMove();started = 1;}}, 1500 );
	

	/*

	$("#start2").click( function(){
		getNextMove();
	});

	*/
});
}