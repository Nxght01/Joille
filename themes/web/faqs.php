
<?php
echo $this->layout("_theme");
?>
<?php
$this->start("specific-script");
?>
<script src="assets/js/scripts-faqs.js"></script>
<?php
$this->end();
?>


<!-- metodo 1 -->


<!--
<div class="faq">
    <h1 class="faq-question">Pergunta 1</h1>
    <p class="faq-answer">Resposta 1</p>
</div>
<div class="faq">
    <h1 class="faq-question">Pergunta 2</h1>
    <p class="faq-answer">Resposta 2</p>
</div>
<div class="faq">
    <h1 class="faq-question">Pergunta 2</h1>
    <p class="faq-answer">Resposta 2</p>
</div>
-->


<!-- metodo 2 -->


<?php


    //var_dump($questions);
    /*foreach ($questions as $question){
        echo "
        <div class=\"faq\">
            <h1 class=\"faq-question\">{$question->question}</h1>
            <p class=\"faq-answer\">{$question->answer}</p>
        </div>
        ";
    }*/




?>
  

<!-- metodo 3 --> 


<?php
    foreach ($questions as $question):
?>
        <div class="faq">
            <h1 class="faq-question"><?= $question->question; ?></h1>
            <p class="faq-answer"><?= $question->answer; ?></p>
        </div>
<?php
    endforeach;
?>
