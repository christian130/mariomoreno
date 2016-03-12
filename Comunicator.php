<?php



function notifications_number($bool = false) {
    if($bool)return rand(0, 15);
    echo rand(0, 15);
    }

function messages_number($bool = false) {
    if($bool)return rand(0, 15);
    echo rand(0, 15);
    }

function posts_number($bool = false) {
    if($bool)return rand(0, 15);
    echo rand(0, 15);
       
}

function messages($qtd) {
    $var = '';
    for ($i = 0; $i < $qtd; $i++) {      
        $bg = $i % 2 == 0 ? " nobg" : "";
        $var .= '<div class="messageswrap' . $bg . '">
                    <img src="images/dr1.jpg" alt="" class="dimg" />            
                    <h4>Message!</h4>
                    <p>Wants to add you as a friend</p>
                    </div>';
        ;
    }
    $var.='<h5>See all</h5>';
    echo $var;
}

function notifications($qtd) {
    $var = '';
    for ($i = 0; $i < $qtd; $i++) {      
        $bg = $i % 2 == 0 ? " nobg" : "";
        $var .= '<div class="notificationwrap' . $bg . '">
        <img src="images/dr1.jpg" alt="" class="dimg" />            
                    <h4>Message!</h4>
                    <p>Wants to add you as a friend</p>
                    </div>';
        ;
    }
    $var.='<h5>See all</h5>';
    echo $var;
}

function posts($qtd) {
    $var = '';
        for ($i = 0; $i < $qtd; $i++) {      
        $var .=   '<div class="crispbx"> <img alt="" src="images/fbim.jpg">
                    <div class="crispcont">
                        <h2>Christopher Schmit</h2>
                        <p>Robin Thicke sues Marvin Gaye\s family before they can sue him
                            over “Blurred Lines” sounding like “Got to Give It Up” <br>
                            testing</p>
                        <div class="likemenu">
                            <ul>
                                <li><a href="#">Like</a></li>
                                <li><a href="#">Comment</a></li>
                                <li><a href="#">Share</a></li>
                            </ul>
                        </div>
                    </div>
                </div>';
    }
    $var.='';
    echo $var;
}

function numbers(){
    $value = '{'.'"posts":'.  posts_number(true).','.
        '"notifications":'. notifications_number(true).','.
        '"messages":'.  messages_number(true)        
    .'}';
    
        
     echo $value;
//     return $value;
}

$funct = $_POST['func'];
$qtd = $_POST['qtd'];

switch ($funct) {
    case "messages_number":
        return messages_number();
        break;
    case "notifications_number":
        return notifications_number();
        break;
    case "posts_number":
        return posts_number();
        break;
    case "posts":
        return posts($qtd);
        break;
    case "messages":
        return messages($qtd);
        break;
    case "notifications":
        return notifications($qtd);
        break;
    case "numbers":
        return numbers();
        break;
}

    


