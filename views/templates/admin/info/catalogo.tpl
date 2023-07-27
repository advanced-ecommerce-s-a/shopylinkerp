{**
* 2018-2023 Optyum S.A. All Rights Reserved.
*
* NOTICE:  All information contained herein is, and remains
* the property of Optyum S.A. and its suppliers,
* if any.  The intellectual and technical concepts contained
* herein are proprietary to Optyum S.A.
* and its suppliers and are protected by trade secret or copyright law.
* Dissemination of this information or reproduction of this material
* is strictly forbidden unless prior written permission is obtained
* from Optyum S.A.
*
* @author    Optyum S.A.
* @copyright 2018-2023 Optyum S.A.
* @license  Optyum S.A. All Rights Reserved
*  International Registered Trademark & Property of Optyum S.A.
*}

{assign var="active" value="catalogo"}

<div class="row login">
    <div class="row">
        <div class="col-md-9">
            <div class="shopyheader">
                <h2>{l s='Catalog optimization system' mod='shopylinkerp'}</h2>
            </div>
            <div class="col-md-offset-1 col-md-10 shopyinfopanel">
                <h2>{l s='Catalog optimization system' mod='shopylinkerp'}</h2>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question1" role="button"
                       aria-expanded="true" aria-controls="question1">
                        {l s='How is the catalog optimized?' mod='shopylinkerp'}
                    </a>
                    <div class="collapse in" id="question1">
                        <div class="card card-body questbody">
                            <p>
                                {l s="For the optimization of the Shopylinker catalog, it provides the SQI (Score Quality Information) tool that, through an algorithm, determines the level of quality of the information in each category, product and brand, informing of the necessary improvements and providing a quick system for updating the information to improve the level of quality." mod='shopylinkerp'}
                            </p>

                            <a data-image-url="SQI%20accesible%20en%20todos%20los%20entornos%20del%20cat%C3%A1logo.png" data-target="#modalimg" class="linkinfo imagelink" href="#">{l s='SQI accessible in all catalog environments' mod='shopylinkerp'}<i
                                        class="icon_Ver_imagen"></i></a><br>

                            <a data-image-url="Tarjeta%20de%20producto%20indicando%20el%20Score.png" data-target="#modalimg" class="linkinfo imagelink" href="#">{l s='Product card indicating the Score' mod='shopylinkerp'}<i
                                        class="icon_Ver_imagen"></i></a><br>
                            <a data-image-url="Indicaci%C3%B3n%20de%20propiedades%20a%20mejorar.png" data-target="#modalimg" class="linkinfo imagelink" href="#">{l s='Indication of properties to improve' mod='shopylinkerp'}<i
                                        class="icon_Ver_imagen"></i></a><br>
                            <a data-image-url="actualizacioninstantaneascore.png" data-target="#modalimg" class="linkinfo imagelink" href="#">{l s='Instant Score Update' mod='shopylinkerp'}<i
                                        class="icon_Ver_imagen"></i></a><br>

                            <a class="linkinfo" href="https://www.youtube.com/watch?v=sFoqbHWOl8E"
                               target="_blank">{l s='SQI presentation' mod='shopylinkerp'}<i
                                        class="icon_Video"></i></a><br>
                        </div>
                    </div>
                </div>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question2" role="button"
                       aria-expanded="false" aria-controls="question2">
                        {l s='How is the catalog optimization process carried out?' mod='shopylinkerp'}
                    </a>
                    <div class="collapse " id="question2">
                        <div class="card card-body questbody">
                            <p>
                                {l s="The catalog optimization process is performed for each product, category and brand page published on the store front using SEO best practices." mod='shopylinkerp'}
                            </p>
                            <p>
                                {l s="Prior to any type of optimization, the category structure, the products and combinations that make up the catalog must be created, as well as the languages ​​in which the store will be published, the common characteristics and their values (if fixed) must be defined for the products belonging to each category and must be entered as characteristics in the corresponding categories." mod='shopylinkerp'}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question3" role="button"
                       aria-expanded="false" aria-controls="question3">
                        {l s='Manual guided optimization of the catalog.' mod='shopylinkerp'}
                    </a>
                    <div class="collapse" id="question3">
                        <div class="card card-body questbody">
                            <p>
                                {l s="Perform guided optimization by filling in the requested information in the order in which it is requested. The SQI system will update the score of the category, product or brand that is being optimized in real time." mod='shopylinkerp'}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question4" role="button"
                       aria-expanded="false" aria-controls="question4">
                        {l s='What criteria does the SQI algorithm use to assign the information score?' mod='shopylinkerp'}
                    </a>
                    <div class="collapse" id="question4">
                        <div class="card card-body questbody">
                            <p>
                                {l s="Currently, the SQI algorithm analyzes more than 75 product properties, combinations, categories, and brands. It has been designed to evaluate detailed and consistent information between comparable products. Depending on the type of feature, perform the analysis following SEO best practices." mod='shopylinkerp'}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question5" role="button"
                       aria-expanded="false" aria-controls="question5">
                        {l s='Is it necessary to perform any specific configuration for the optimization of the catalog?' mod='shopylinkerp'}
                    </a>
                    <div class="collapse" id="question5">
                        <div class="card card-body questbody">
                            <p>
                                {l s="It is not strictly necessary, but in order to improve the optimization of the catalog it is highly recommended to define at the category level the characteristics that the products it includes must include." mod='shopylinkerp'}
                            </p>
                            <p>
                                {l s="This assignment of characteristics at the category level (available only with Shopylinker) is taken into account in the SQI optimization and contributes to improve the completeness and homogeneity of the information." mod='shopylinkerp'}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question6" role="button"
                       aria-expanded="false" aria-controls="question6">
                        {l s='What new features can I expect in the next version of SQI?' mod='shopylinkerp'}
                    </a>
                    <div class="collapse" id="question6">
                        <div class="card card-body questbody">
                            <p>
                                {l s="During the third quarter of 2023, SQI V.3 will be released. In addition to including new properties and improvements to the algorithm, this new version, which is supported by artificial intelligence, facilitates the guided optimization of the catalog through the generation of original texts and automated translations." mod='shopylinkerp'}
                            </p>
                            <p>
                                {l s="Additionally, this new version introduces the automated optimization of the catalog that, by means of queries to different product databases, allows the optimization of the product sheets by entering minimum product data." mod='shopylinkerp'}
                            </p>
                            <p>
                                {l s="To guarantee the originality of the information, the information extracted from the databases is updated with the use of AI." mod='shopylinkerp'}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="row questionbox ">
                    <a class="question" data-toggle="collapse" href="#question7" role="button"
                       aria-expanded="false" aria-controls="question7">
                        {l s='In the SQI version will it be possible to optimize products massively?' mod='shopylinkerp'}
                    </a>
                    <div class="collapse" id="question7">
                        <div class="card card-body questbody">
                            <p>
                                {l s="Yes, in the next version of SQI it is possible to update multiple products with a single action, and the administrator must, prior to publication, show his agreement with all the modified information, making the necessary modifications where appropriate." mod='shopylinkerp'}
                            </p>
                            <p>
                                {l s="Conformity with the modified information, or not, is easily done by marking a check on a screen designed for easy review of the information." mod='shopylinkerp'}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-2">
            {include file="module:shopylinkerp/views/templates/admin/sidebar.tpl" var=active}
        </div>
    </div>

</div>
