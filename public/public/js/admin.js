/* globals Chart:false, feather:false */

(function () {
    'use strict'
  
    feather.replace()
  
    // Graphs
    var ctx = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          'Sunday',
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday'
        ],
        datasets: [{
          data: [
            15339,
            21345,
            18483,
            24003,
            23489,
            24092,
            12034
          ],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
  }());
/**
 * Delete modal function
 */
  $(document).ready(function(){
    // For A Delete Record Popup
    $('.remove-record').click(function() {
      var id = $(this).attr('data-id');
      var url = $(this).attr('data-url');
      var token = CSRF_TOKEN;
      $(".remove-record-model").attr("action",url);
      $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
      $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
      $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    });
  
    $('.remove-data-from-delete-form').click(function() {
      $('body').find('.remove-record-model').find( "input" ).remove();
    });
    $('.modal').click(function() {
       $('body').find('.remove-record-model').find( "input" ).remove();
    });
  });