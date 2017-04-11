<?php

/* {# inline_template_start #}destination=/personal_expenses/admin/structure/views/view/view_bank_account/preview/page_1 */
class __TwigTemplate_c9b4ba3026f0bced0ae7108dd0683fd8de48d22503bfd01c7edd16cce9ea8096 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array();
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "destination=/personal_expenses/admin/structure/views/view/view_bank_account/preview/page_1";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}destination=/personal_expenses/admin/structure/views/view/view_bank_account/preview/page_1";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }
}
/* {# inline_template_start #}destination=/personal_expenses/admin/structure/views/view/view_bank_account/preview/page_1*/
