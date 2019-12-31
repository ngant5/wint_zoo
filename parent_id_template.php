<ul class="treeview">
   <li id="li_1" class="contains-items">
      <div class="checkbox">
         <input id="1" type="checkbox" value="1" name="categories[]">
         <label for="1">
         Floor
         </label>
      </div>
      <ul>
         <li class="li_1">
            <div class="checkbox">
               <input id="4" type="checkbox" value="4" name="categories[]">
               <label for="4">
               1st Floor
               </label>
            </div>
         </li>
         <li class="li_1">
            <div class="checkbox">
               <input id="5" type="checkbox" value="5" name="categories[]">
               <label for="5">
               2nd Floor
               </label>
            </div>
         </li>
         <li class="li_1">
            <div class="checkbox">
               <input id="6" type="checkbox" value="6" name="categories[]">
               <label for="6">
               3rd Floor
               </label>
            </div>
         </li>
      </ul>
   </li>
   <li id="li_2">
      <div class="checkbox">
         <input id="2" type="checkbox" value="2" name="categories[]">
         <label for="2">
         Rent
         </label>
      </div>
   </li>
   <li id="li_3" class="contains-items">
      <div class="checkbox">
         <input id="3" type="checkbox" value="3" name="categories[]">
         <label for="3">
         View
         </label>
      </div>
      <ul>
         <li class="li_3">
            <div class="checkbox">
               <input id="7" type="checkbox" value="7" name="categories[]">
               <label for="7">
               Pool View
               </label>
            </div>
         </li>
         <li class="li_3">
            <div class="checkbox">
               <input id="8" type="checkbox" value="8" name="categories[]">
               <label for="8">
               Mountain View
               </label>
            </div>
         </li>
         <li class="li_3">
            <div class="checkbox">
               <input id="9" type="checkbox" value="9" name="categories[]">
               <label for="9">
               Courtyard
               </label>
            </div>
         </li>
      </ul>
   </li>
</ul>


$('input[type=checkbox]').change(function(){
            // if is checked
            if($(this).is(':checked')){

                // check all children
                $(this).parent().siblings().find('li input[type=checkbox]').prop('checked', true);

                //if all siblings are checked, check its parent checkbox
                if($(this).parent().siblings('li input[type=checkbox]').is(":checked")) {
                    console.log('all siblings checked');
                    //check its parent checkbox
                }else{
                    console.log('not all siblings checked');
                }

            } else {

                // uncheck all children
                $(this).parent().siblings().find('li input[type=checkbox]').prop('checked', false);

            }

        });