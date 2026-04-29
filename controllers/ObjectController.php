<?php

class ObjectController extends TwigBaseController {
    public $template = "object.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->query("SELECT title, id FROM synthesizers WHERE id=3");
        $data = $query->fetch();
        $context['title'] = $data['title'];

        return $context;
    }
}