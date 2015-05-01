<?php Helper::renderFlash($SUCCESS_MESSAGE); ?>

<div class="tab-pane profile-classic row-fluid <?php if (!Helper::get('tab')) { ?>active<?php } ?>" id="tab_1_2">
    <div class="span2">
        <img src="<?php echo Helper::baseUrl(); ?>/uploads/avatar/<?php echo Helper::explodeCharData($model->avatar, ',', true); ?>" alt="<?php echo $model->username; ?>" />
        <a href="<?php echo Helper::url('/Admin/user/profile', array('tab' => 'account', 'action' => 'changeAvatar')); ?>#tab_2-2" class="profile-edit" title="Edit">edit</a>
    </div>
    <ul class="unstyled span10">
        <li><span>User Name:</span> <?php echo $model->username; ?></li>
        <li><span>Full Name:</span> <?php echo $model->fullname; ?></li>
        <li><span>Counrty:</span> <?php echo $model->country; ?></li>
        <li><span>Birthday:</span> <?php echo date('F j, Y', Helper::changeDateToFormat($model->birthday, 'm-d-Y')); ?></li>
        <li><span>Email:</span> <a href="#"><?php echo $model->email; ?></a></li>
        <li><span>Mobile Number:</span> <?php echo $model->phone; ?></li>
        <li><span>About:</span> <?php echo $model->description; ?></li>
    </ul>
</div>
<!--tab_1_2-->
<div class="tab-pane row-fluid profile-account <?php if (Helper::get('tab') == 'account') { ?>active<?php } ?>" id="tab_1_3">
    <div class="row-fluid">
        <div class="span12">
            <div class="span3">
                <ul class="ver-inline-menu tabbable margin-bottom-10">
                    <li class="<?php if (Helper::get('action') == 'personal-info') { ?>active<?php } ?>">
                        <a data-toggle="tab" href="<?php echo Helper::url('/Admin/user/profile', array('tab' => 'account', 'action' => 'personal-info')); ?>#tab_1-1">
                        <i class="icon-cog"></i>
                        Personal info
                        </a>
                        <span class="after"></span>
                    </li>
                    <li class="<?php if (Helper::get('action') == 'changeAvatar') { ?>active<?php } ?>"><a data-toggle="tab" href="<?php echo Helper::url('/Admin/user/profile', array('tab' => 'account', 'action' => 'changeAvatar')); ?>#tab_2-2"><i class="icon-picture"></i> Change Avatar</a></li>
                    <li class="<?php if (Helper::get('action') == 'changePassword') { ?>active<?php } ?>"><a data-toggle="tab" href="<?php echo Helper::url('/Admin/user/profile', array('tab' => 'account', 'action' => 'changePassword')); ?>#tab_3-3"><i class="icon-lock"></i> Change Password</a></li>
                    <li class=""><a data-toggle="tab" href="#tab_4-4"><i class="icon-eye-open"></i> Privacity Settings</a></li>
                </ul>
            </div>
            <div class="span9">
                <div class="tab-content">
                    <div class="tab-pane <?php if (Helper::get('action') == 'personal-info') { ?>active<?php } ?>">
                        <div style="height: auto;" id="accordion1-1" class="accordion collapse">
                            <?php $formInfo=$this->beginWidget('CActiveForm', array(
                                    'id'=>'user-form',
                                    'enableClientValidation' => true,
                                    'enableAjaxValidation'   => true,
                                    'clientOptions'          => array(
                                        'validateOnSubmit' => true,
                                        'afterValidateAttribute' => 'js:function(){
                                        }',
                                    ),
                                )
                            );?>
                            <?php echo $formInfo->errorSummary($model); ?>


                            <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'username'); ?>
                                    <?php echo $formInfo->textField($model, 'username', array('class' => 'm-wrap span4')) ?>
                                    <?php echo $formInfo->error($model, 'username'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'fullname'); ?>
                                    <?php echo $formInfo->textField($model, 'fullname', array('class' => 'm-wrap span8')) ?>
                                    <?php echo $formInfo->error($model, 'fullname'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'email'); ?>
                                    <?php echo $formInfo->textField($model, 'email', array('class' => 'm-wrap span8')) ?>
                                    <?php echo $formInfo->error($model, 'email'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'phone'); ?>
                                    <?php echo $formInfo->textField($model, 'phone', array('class' => 'm-wrap span4')) ?>
                                    <?php echo $formInfo->error($model, 'phone'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'address'); ?>
                                    <?php echo $formInfo->textField($model, 'address', array('class' => 'm-wrap span8')) ?>
                                    <?php echo $formInfo->error($model, 'address'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'country'); ?>
                                    <?php echo $formInfo->textField($model, 'country', array('class' => 'm-wrap span8')) ?>
                                    <?php echo $formInfo->error($model, 'country'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'description'); ?>
                                    <?php echo $formInfo->textArea($model, 'description', array('placeholder' => 'Occupation, Hobbies ...', 'class' => 'm-wrap span8', 'row' => 3)) ?>
                                    <?php echo $formInfo->error($model, 'description'); ?>
                                </div>

                                <div class="control-group">
                                    <?php echo $formInfo->labelEx($model, 'website'); ?>
                                    <?php echo $formInfo->textField($model, 'website', array('placeholder' => 'http://web3in1.com', 'class' => 'm-wrap span8')) ?>
                                    <?php echo $formInfo->error($model, 'website'); ?>
                                </div>

                                <div class="submit-btn">
                                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
                                    <?php echo CHtml::resetButton('Reset', array('class' => 'btn')); ?>

                                </div>
                            <?php $this->endWidget(); ?>

                        </div>
                    </div>
                    <div id="tab_2-2" class="tab-pane <?php if (Helper::get('action') == 'changeAvatar') { ?>active<?php } ?>">
                        <div style="height: auto;" id="accordion2-2" class="accordion collapse">
                            <?php $formUpload = $this->beginWidget('CActiveForm', array(
                                    'id' => 'user-upload-form',
                                    'htmlOptions' => array('enctype' => 'multipart/form-data')
                                )
                            );?>
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                <br />

                                <?php if (!$model->isNewRecord) { ?>
                                    <?php $userAvatar = Helper::explodeCharData($model->avatar, ',', true); ?>
                                <div class="controls">
                                    <div class="thumbnail" style="width: 291px; height: 170px;">
                                        <img src="uploads/avatar/<?php echo $userAvatar; ?>" alt="<?php $model->username; ?>" />
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="space10"></div>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <?php echo $formUpload->hiddenField($model, "avatar"); ?>
                                        <?php $this->widget('CMultiFileUpload', array(
                                            'name'      => 'avatar',
                                            'accept'    => 'jpeg|jpg|gif|png', // useful for verifying files
                                            'duplicate' => 'Duplicate file!', // useful, i think
                                            'denied'    => 'Invalid file type', // useful, i think
                                        ));
                                        echo $formUpload->error($model, 'avatar');

                                        if ($model->avatar):
                                            $avatar = explode(',', $model->avatar);
                                            foreach ($avatar as $k => $file):
                                                ?>
                                                <div class="clearfix"></div>
                                                <span><?php echo $file; ?> &nbsp;<a href="javascript:;"
                                                        onclick="javascript:removeFile('<?php echo $file; ?>', <?php echo $k; ?>)" title="Remove"
                                                        class="remove_<?php echo $k; ?>">Remove File</a></span>
                                                <div class="clearfix"></div>
                                            <?php
                                            endforeach;
                                        endif;?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="controls">
                                    <span class="label label-important">NOTE!</span>
                                    <span>You can write some information here..</span>
                                </div>
                                <div class="space10"></div>
                                <div class="submit-btn">
                                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
                                </div>
                            <?php $this->endWidget(); ?>

                        </div>
                    </div>
                    <div class="tab-pane <?php if (Helper::get('action') == 'changePassword') { ?>active<?php } ?>">
                        <div style="height: auto;" id="accordion3-3" class="accordion collapse">
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'user-changePassword-form',
                                'enableAjaxValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,),
                            )); ?>
                                <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
                                <?php echo $form->passwordField($model, 'password', array('maxlength' => 32, 'class' => 'm-wrap span8')); ?>
                                <?php echo $form->error($model, 'password', array('class' => 'errorMessage')); ?>

                                <?php echo $form->labelEx($model, 'passwordNew', array('class' => 'control-label')); ?>
                                <?php echo $form->passwordField($model, 'passwordNew', array('maxlength' => 32, 'class' => 'm-wrap span8')); ?>
                                <?php echo $form->error($model, 'passwordNew', array('class' => 'errorMessage')); ?>

                                <?php echo $form->labelEx($model, 'confirmPassword', array('class' => 'control-label')); ?>
                                <?php echo $form->passwordField($model, 'confirmPassword', array('maxlength' => 32, 'class' => 'm-wrap span8')); ?>
                                <?php echo $form->error($model, 'confirmPassword', array('class' => 'errorMessage')); ?>

                                <div class="submit-btn">
                                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
                                    <?php echo CHtml::button('Cancel', array('class' => 'btn')); ?>
                                </div>
                            <?php $this->endWidget(); ?>

                        </div>
                    </div>
                    <div id="tab_4-4" class="tab-pane">
                        <div style="height: auto;" id="accordion4-4" class="accordion collapse">
                            <form action="#">
                                <div class="profile-settings row-fluid">
                                    <div class="span9">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..</p>
                                    </div>
                                    <div class="control-group span3">
                                        <div class="controls">
                                            <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option1" />
                                            Yes
                                            </label>
                                            <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" checked />
                                            No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--end profile-settings-->
                                <div class="profile-settings row-fluid">
                                    <div class="span9">
                                        <p>Enim eiusmod high life accusamus terry richardson ad squid wolf moon</p>
                                    </div>
                                    <div class="control-group span3">
                                        <div class="controls">
                                            <label class="checkbox">
                                            <input type="checkbox" value="" /> All
                                            </label>
                                            <label class="checkbox">
                                            <input type="checkbox" value="" /> Friends
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--end profile-settings-->
                                <div class="profile-settings row-fluid">
                                    <div class="span9">
                                        <p>Pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson</p>
                                    </div>
                                    <div class="control-group span3">
                                        <div class="controls">
                                            <label class="checkbox">
                                            <input type="checkbox" value="" /> Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--end profile-settings-->
                                <div class="profile-settings row-fluid">
                                    <div class="span9">
                                        <p>Cliche reprehenderit enim eiusmod high life accusamus terry</p>
                                    </div>
                                    <div class="control-group span3">
                                        <div class="controls">
                                            <label class="checkbox">
                                            <input type="checkbox" value="" /> Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--end profile-settings-->
                                <div class="profile-settings row-fluid">
                                    <div class="span9">
                                        <p>Oiusmod high life accusamus terry richardson ad squid wolf fwopo</p>
                                    </div>
                                    <div class="control-group span3">
                                        <div class="controls">
                                            <label class="checkbox">
                                            <input type="checkbox" value="" /> Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--end profile-settings-->
                                <div class="space5"></div>
                                <div class="submit-btn">
                                    <a href="#" class="btn green">Save Changes</a>
                                    <a href="#" class="btn">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end span9-->
        </div>
    </div>
</div>
<!--end tab-pane-->
<div class="tab-pane <?php if (Helper::get('tab') == 'projects') { ?>active<?php } ?>" id="tab_1_4">
    <div class="row-fluid add-portfolio">
        <div class="pull-left">
            <span>502 Items sold this week</span>
        </div>
        <div class="pull-right">
            <a href="#" class="btn icn-only green">Add a new Project <i class="m-icon-swapright m-icon-white"></i></a>
        </div>
    </div>
    <!--end add-portfolio-->
    <div class="row-fluid portfolio-block">
        <div class="span5 portfolio-text">
            <img src="<?php echo Helper::themeUrl(); ?>/assets/img/profile/portfolio/logo_metronic.jpg" alt="" />
            <div class="portfolio-text-info">
                <h4>Metronic - Responsive Template</h4>
                <p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
            </div>
        </div>
        <div class="span5" style="overflow:hidden;">
            <div class="portfolio-info">
                Today Sold
                <span>187</span>
            </div>
            <div class="portfolio-info">
                Total Sold
                <span>1789</span>
            </div>
            <div class="portfolio-info">
                Earns
                <span>$37.240</span>
            </div>
        </div>
        <div class="span2 portfolio-btn">
            <a href="#" class="btn bigicn-only"><span>Manage</span></a>
        </div>
    </div>
    <!--end row-fluid-->
    <div class="row-fluid portfolio-block">
        <div class="span5 portfolio-text">
            <img src="<?php echo Helper::themeUrl(); ?>/assets/img/profile/portfolio/logo_azteca.jpg" alt="" />
            <div class="portfolio-text-info">
                <h4>Metronic - Responsive Template</h4>
                <p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
            </div>
        </div>
        <div class="span5">
            <div class="portfolio-info">
                Today Sold
                <span>24</span>
            </div>
            <div class="portfolio-info">
                Total Sold
                <span>660</span>
            </div>
            <div class="portfolio-info">
                Earns
                <span>$7.060</span>
            </div>
        </div>
        <div class="span2 portfolio-btn">
            <a href="#" class="btn bigicn-only"><span>Manage</span></a>
        </div>
    </div>
    <!--end row-fluid-->
    <div class="row-fluid portfolio-block">
        <div class="span5 portfolio-text">
            <img src="<?php echo Helper::themeUrl(); ?>/assets/img/profile/portfolio/logo_conquer.jpg" alt="" />
            <div class="portfolio-text-info">
                <h4>Metronic - Responsive Template</h4>
                <p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
            </div>
        </div>
        <div class="span5" style="overflow:hidden;">
            <div class="portfolio-info">
                Today Sold
                <span>24</span>
            </div>
            <div class="portfolio-info">
                Total Sold
                <span>975</span>
            </div>
            <div class="portfolio-info">
                Earns
                <span>$21.700</span>
            </div>
        </div>
        <div class="span2 portfolio-btn">
            <a href="#" class="btn bigicn-only"><span>Manage</span></a>
        </div>
    </div>
    <!--end row-fluid-->
</div>
<!--end tab-pane-->
<div class="tab-pane row-fluid" id="tab_1_6">
    <div class="row-fluid">
        <div class="span12">
            <div class="span3">
                <ul class="ver-inline-menu tabbable margin-bottom-10">
                    <li class="active">
                        <a data-toggle="tab" href="#tab_1">
                        <i class="icon-briefcase"></i>
                        General Questions
                        </a>
                        <span class="after"></span>
                    </li>
                    <li><a data-toggle="tab" href="#tab_2"><i class="icon-group"></i> Membership</a></li>
                    <li><a data-toggle="tab" href="#tab_3"><i class="icon-leaf"></i> Terms Of Service</a></li>
                    <li><a data-toggle="tab" href="#tab_1"><i class="icon-info-sign"></i> License Terms</a></li>
                    <li><a data-toggle="tab" href="#tab_2"><i class="icon-tint"></i> Payment Rules</a></li>
                    <li><a data-toggle="tab" href="#tab_3"><i class="icon-plus"></i> Other Questions</a></li>
                </ul>
            </div>
            <div class="span9">
                <div class="tab-content">
                    <div id="tab_1" class="tab-pane active">
                        <div style="height: auto;" id="accordion1" class="accordion collapse">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_1" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse in" id="collapse_1">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Pariatur cliche reprehenderit enim eiusmod highr brunch ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Food truck quinoa nesciunt laborum eiusmod nim eiusmod high life accusamus  ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_4" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                    High life accusamus terry richardson ad ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_4">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_5" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_5">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_6" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Wolf moon officia aute non cupidatat skateboard dolor brunch ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_6">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab_2" class="tab-pane">
                        <div style="height: auto;" id="accordion2" class="accordion collapse">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_1" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Cliche reprehenderit, enim eiusmod high life accusamus enim eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse in" id="collapse_2_1">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Pariatur cliche reprehenderit enim eiusmod high life non cupidatat skateboard dolor brunch ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2_2">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_3" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Food truck quinoa nesciunt laborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2_3">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_4" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    High life accusamus terry richardson ad squid enim eiusmod high ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2_4">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_5" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2_5">
                                    <div class="accordion-inner">
                                        <p>
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </p>
                                        <p>
                                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_6" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Wolf moon officia aute non cupidatat skateboard dolor brunch ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2_6">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_2_7" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_2_7">
                                    <div class="accordion-inner">
                                        <p>
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </p>
                                        <p>
                                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab_3" class="tab-pane">
                        <div style="height: auto;" id="accordion3" class="accordion collapse">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_1" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Cliche reprehenderit, enim eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse in" id="collapse_3_1">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_2" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Pariatur skateboard dolor brunch ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_2">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_3" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Food truck quinoa nesciunt laborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_3">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_4" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    High life accusamus terry richardson ad squid enim eiusmod high ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_4">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_5" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Reprehenderit enim eiusmod high  eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_5">
                                    <div class="accordion-inner">
                                        <p>
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </p>
                                        <p>
                                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_6" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_6">
                                    <div class="accordion-inner">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_7" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Reprehenderit enim eiusmod high life accusamus aborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_7">
                                    <div class="accordion-inner">
                                        <p>
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </p>
                                        <p>
                                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#collapse_3_8" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">
                                    Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?
                                    </a>
                                </div>
                                <div class="accordion-body collapse" id="collapse_3_8">
                                    <div class="accordion-inner">
                                        <p>
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </p>
                                        <p>
                                            moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end span9-->
        </div>
    </div>
</div>
<!--end tab-pane-->


<?php
$scriptChangeTab = '
    $(function () {
        $(".tabbable li a").click(function () {
            var href = $(this).attr("href");
            window.location = href;
        });
    });
';
Helper::cs()->registerScript('scriptChangeTab', $scriptChangeTab, CClientScript::POS_END);


$scriptDelete = '
    if("' . $model->avatar . '" != ""){
        function removeFile(fileName, pos) {
            var url = "' . Helper::url('/SuperAdmin/default/deleteimage') .'";
            var imageID = "' . $model->id . '";

            $.post(
                url, { imageID: imageID, imageName: fileName, model: "User", colImage: "avatar" },
                function(data){
                    $("a.remove_"+pos).parent().remove();
                    parent.window.location = parent.window.location
                }, "json"
            );

            return false;
        }
    }
';
Helper::cs()->registerScript('scriptDelete', $scriptDelete, CClientScript::POS_END);