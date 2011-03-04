<?php

if($session->check('Message.auth')){
	echo $session->flash('auth');
}
echo '<div style="width:450px;float:left;">';

echo $form->create('User',array('action'=>'login'));
echo '<table border="1">
<tbody>
    <tr>
    	<th align="left">ユーザーID</th>
    	<td>';

echo $form->text('User.loginid',array('size'=>'30'));

echo '</td>
    </tr>
    <tr>
    	<th align="left">パスワード</th>
    	<td>';

echo $form->password('User.password',array('size'=>'30'));

echo '</td>
    </tr>
  	</tbody>
	</table>';

echo $form->end('ログイン');

?>