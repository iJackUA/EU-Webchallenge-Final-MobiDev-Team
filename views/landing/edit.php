<?php
/* @var $this yii\web\View */
/* @var $landing app\models\gii\Landing */

$this->title = $landing->title;
\app\assets\BuilderAsset::register($this);
?>

<div class="container-fluid" id="awesome-builder">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <button
                type="button"
                class="btn btn-info"
                v-on="click:saveLanding($event)"
            >Save
            </button>
            <br>

            Title:
            <textarea v-model="title" rows="2" class="form-control"></textarea>
            Slug:
            <input type="text" v-model="slug" class="form-control">
            <br>
            <a href="/<?= $landing->slug ?>" class="btn btn-default" target="_blank">Preview</a>

            <h4>Sections</h4>

            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle"
                        data-toggle="dropdown">
                    Add section... <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li v-repeat="s in defaultSections">
                        <a href="#"
                           v-on="click:addSection(s.type, $event)"
                        >{{sectionName(s)}}</a></li>
                </ul>
            </div>

            <ul class="nav nav-sidebar" v-cloak>
                <li v-repeat="s in sections"
                    v-transition="expand"
                    v-on="click:changeSection($index, $event)"
                >
                    <a href="">{{sectionName(s)}}</a>
                </li>
            </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak>
            <div v-if="currentSectionExists">

                <heading
                    s="{{@ currentSection.meta}}"
                    v-if="currentSection.type == 'heading'"
                ></heading>

                <gallery
                    s="{{@ currentSection.meta}}"
                    v-if="currentSection.type == 'gallery'"
                ></gallery>

                <services
                    s="{{@ currentSection.meta}}"
                    v-if="currentSection.type == 'services'"
                ></services>

                <contacts
                    s="{{@ currentSection.meta}}"
                    v-if="currentSection.type == 'contacts'"
                ></contacts>

            </div>

            <div class="alert alert-warning" v-if="!currentSectionExists">
                No sections found. Go and create some!
            </div>

        </div>
    </div>
</div>
