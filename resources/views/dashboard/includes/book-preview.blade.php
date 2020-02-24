<!--preview modal-->
<div class="modal fade" id="bk_preview_modal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" id="bk_preview_md_hold" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 10px">
                <h4 class="modal-title" id="preview_title">Book preview</h4>
                <button type="button" class="close preview-cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>

            <div class="modal-body row">
                <div class="col-md-4">
                    <div id="prev_itm_img">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="preview-info-holder">
                        <h3 style="border-bottom: 1px #ddd solid; margin-bottom: 10px">Product details</h3>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Title:</label>
                            </div>
                            <div class="col-8 preview-text">
                                <span id="prev_itm_title"></span>
                            </div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Description:</label>
                            </div>
                            <div class="col-8 preview-text">
                                <span id="prev_itm_desc"></span>
                            </div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Publisher:</label>
                            </div>
                            <div class="col-8 preview-text">
                                <span id="prev_itm_publ">N/A</span>
                            </div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Author:</label>
                            </div>
                            <div class="col-8 preview-text">
                                <span id="prev_itm_book_author">N/A</span>
                            </div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>ISBN:</label>
                            </div>
                            <div class="col-8 preview-text">
                                <span id="prev_itm_isbn"></span>
                            </div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Item state:</label>
                            </div>
                            <div class="col-8 preview-text" id="prev_itm_stat"></div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Price:</label>
                            </div>
                            <div class="col-8 preview-text">
                                <span id="prev_totl_price"></span>
                                <span id="prev_dis_rate"></span>
                                <span id="prev_old_price"></span>
                            </div>
                        </div>
                        <div class="row preview-row">
                            <div class="col-4">
                                <label>Category:</label>
                            </div>
                            <div class="col-8 preview-text prev-a">
                                <a href="javascript:void (0)" id="prev_itm_categ"></a>
                                <span id="prev_sub_categ1"></span>
                                <span id="prev_sub_categ2"></span>
                            </div>

                        </div>
                        <div class="row preview-row">
                            <div class="preview-footer">
                                <span>Uploaded By:</span>
                                <span id="upload_by"></span>
                                <span id="upload_date"></span>
                                <span>Last modified By:</span>
                                <span id="last_modified"></span>
                                <span id="modified_date"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/preview modal-->
