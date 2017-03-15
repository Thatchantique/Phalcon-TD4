<?php

/**
 * Class TestController
 * @property Ajax\JsUtils $jquery
 */
class TestController extends \Phalcon\Mvc\Controller
{
    /**
     * @var Ajax\Semantic
     *
     */
    protected $semantic;

    public function initialize()
    {
        $this->semantic = $this->jquery->semantic();
    }

    public function indexAction()
    {
    }

    public function getSimpleAction()
    {

        $btPage1 = $this->semantic->htmlButton("btPage1");
        $btPage2 = $this->semantic->htmlButton("btPage2");
        $btPage1->on("mouseover",$this->jquery->html("#pageContent","kdsjfdjksf"));

        $pageContent = $this->semantic->htmlMessage("pageContent");
        $btPage1->getOnClick("test/page1", "#pageContent");
        $btPage2->getOnClick("test/page2", "#pageContent");
        //
        $this->jquery->compile($this->view);


    }

    public function getSimple2Action()
    {
        $buttons = $this->semantic->htmlButtonGroups("bg1", array("One", "Two"));
        $buttons->getElement(0)->setPositive();
        //$buttons->insertOr();
        $buttons->setPropertyValues("data-ajax", ["page1", "page2"]);
        $buttons->getOnClick("test", "#pageContent", ["attr" => "data-ajax"]);
        $pageContent = $this->semantic->htmlMessage("pageContent");
        $this->jquery->compile($this->view);
    }

    public function page1Action()
    {
        echo "<div>Contenu de la page 1</div>";
    }

    public function page2Action()
    {
        echo "<div>Contenu de la page 2</div>";
    }

    public function hideShowAction()
    {
        $ck = $this->semantic->htmlCheckbox("ckShowHide", "Masquer/afficher");
        $ck->setChecked(true);
        $message = $this->semantic->htmlMessage("zone");
        $message->setIcon("inbox");
        $ck->on("change", $message->jsToggle("$(this).prop('checked')"));
        $this->jquery->compile($this->view);
    }

    public function postFormAction(){
        $formUser = $this->semantic->htmlForm("frm");
        $formUser->addInput("nom","Nom")->setName("nom");
        $formUser->addInput("email","Email")->setName("email");
        $formUser->addSubmit("btValider", "Valider");
        $formUser->submitOnClick("btValider", "test/postReponse", "#divReponse");

        echo $formUser->compile($this->jquery);
        echo $this->jquery->compile($this->view);
        echo "<div id='divReponse'></div>";
    }

    public function postReponseAction()
    {
        $this->view->disable();
        echo "nom : ".$_POST['nom']."</br>"."email : ".$_POST['email']."<br/>";
    }


}

