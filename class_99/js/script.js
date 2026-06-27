// let text = $('input').val();
// console.log(text);

//    $('button').click(function(){
//             // console.log('fogg')
//             let inputvalue = $('input').val();

//             $('h5').text(inputvalue);
//         });


// $('input').keyup(function(){
//             // console.log('fogg')
//             let inputvalue = $('input').val();

//             $('h5').text(inputvalue);
//         });



   $('form').submit(function(e){
           e.preventDefault();

            let inputvalue = $('input').val();

            if(inputvalue == ""){
                $('small').text('plese inter a value');
            }else{
                $('small').text('');
                this.submit();
            }
 
        });










    