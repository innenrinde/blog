<li style="padding-left: <?=($level*30)?>px;"><input type="checkbox" name="category[<?=$id?>]" id="category[<?=$id?>]" value="<?=$id?>" <?=(in_array($id, $selected_categories) ? "checked" : "")?> > <label for="category[<?=$id?>]" style="font-weight: normal;"><?=$name?></label></li>