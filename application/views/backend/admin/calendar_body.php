<div class="calendar-body">
	<div id="event_calendar"></div>
</div>


<script type="text/javascript">
$(document).ready(function()
	{
		var calendar = $('#event_calendar');
		
		calendar.fullCalendar({
			header: {
				left: 'title',
				right: 'month,agendaWeek,agendaDay today prev,next'
			},
			
			//defaultView: 'basicWeek',
			
			editable: false,
			firstDay: 0,
			height: 600,
			droppable: false,

			events:
	        [
	            <?php
	            	$this->db->where('user_type' , $this->session->userdata('login_type'));
	            	$this->db->where('user_id' , $this->session->userdata('login_user_id'));
	            	$events = $this->db->get('calendar_event')->result_array();
	            	foreach ($events as $row):
	            ?>
	                {
	                    title   :   "<?php  echo $row['title'];?>",
	                    start   :   new Date(<?php echo date('Y', $row['start_timestamp']); ?>, 
	                                    <?php echo date('m', $row['start_timestamp']) - 1; ?>, 
	                                    <?php echo date('d', $row['start_timestamp']); ?>),
	                    end    :   new Date(<?php echo date('Y', $row['end_timestamp']); ?>, 
	                                    <?php echo date('m', $row['end_timestamp']) - 1; ?>, 
	                                    <?php echo date('d', $row['end_timestamp']); ?>),
	                    allDay: true,
	                    id: "<?php echo $row['calendar_event_id'];?>",
	                    color: "<?php echo $row['colour'];?>"
	                },
	            <?php endforeach ?>
	        ],

			dayClick: function(date, jsEvent, view) {

		        //alert('Clicked on: ' + date);
		        date =  $.fullCalendar.formatDate( date, "dd-MM-yyyy") ;
		        showAjaxModal('<?php echo base_url();?>index.php?modal/popup/calendar_event_add/' + date);

		        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

		        //alert('Current view: ' + view.name);

		        // change the day's background color just for fun
		        //$(this).css('background-color', 'red');

		    },
		    eventClick: function(calEvent, jsEvent, view) {

		        //alert('Event: ' + calEvent.id);
		        var event_id = calEvent.id;
		        showAjaxModal('<?php echo base_url();?>index.php?modal/popup/calendar_event_edit/' + event_id);
		        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
		        //alert('View: ' + view.name);

		        // change the border color just for fun
		        //$(this).css('border-color', 'red');

		    },
			drop: function(date, allDay) {
				
				var $this = $(this),
					eventObject = {
						title: $this.text(),
						start: date,
						allDay: allDay,
						className: $this.data('event-class')
					};
					
				calendar.fullCalendar('renderEvent', eventObject, true);
				
				$this.remove();
			}
		});

	    $('.fc-day').css('cursor', 'crosshair');
	    $('.fc-event-inner').css('cursor', 'pointer');

	});


</script>