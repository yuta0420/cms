 <?php
   //データの更新処理（更新ボタンを押したとき）
    if(isset($_POST['id_que_edit']) && !empty($_POST['id_que_edit'])){
      if($_POST['sel_type']=="1"){
      $sql='UPDATE `main` SET `title_que`="'.$_POST['question_title'].'",`title_que_sub`="'.$_POST['question_title_sub'].'",`time_edit`=now() WHERE `id_que`='.$_POST['id_que_edit'];

      $stmt =$dbh->prepare($sql);
      $stmt->execute();


      if(isset($_POST['question1']) && !empty($_POST['question1'])){
      for ($i=0; $i < $_POST['num_que_edit']; $i++)
       {

        $sql = 'UPDATE `selection` SET `question`="'.$_POST['question'.$i].'",`choose1`='.$_POST['choose'.$i.'_1'].',`choose2`='.$_POST['choose'.$i.'_2'].',`choose3`='.$_POST['choose'.$i.'_3'].',`choose4`='.$_POST['choose'.$i.'_4'].',`answer`="'.$_POST['ans'.$i].'",`time_edit`=now() WHERE `id_sub`='.$_POST['id_sub_edit'.$i];

        var_dump($sql);
     
                
         //SQL文の実行
         $stmt=$dbh->prepare($sql);
         $stmt->execute();
       }
     }
   }  
  }

?>
