<div class="direct-messages" style="display: none">
        <div class="sidebar-area">
            <div class="sidebar-header-wrap">
                <div class="sidebar-header-col sidebar-header-wrap-title">
                    Сообщения
                </div>
                <div class="sidebar-header-col sidebar-header-col-right">
                    <div>
                        <div class="icon">
                            <span class="underline-opening">закрыть</span>
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-wrap">
                <div class="sidebar__top ps-container">

                    <div class="sidebar__content-block">
                        <div id="message-container">

                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar__footer sidebar__content-block">
                <div id="send-form">
                    <textarea name="message" rows="2" style="width: 100%"></textarea>
                </div>
                <div style="text-align: right">
                    <button id="send" type="submit" class="btn btn-primary" >SEND</button>
                </div>
            </div>
        </div>
</div>
<style>
    .direct-messages {
        height: 100%;
        position: fixed;
        top: 0;
        right: 0;
        max-width: 420px;
        width: 100%;
        background-color: #fff;
        z-index: 9999;
    }

    .sidebar-header-col {
        display: inline-block;
    }

    .sidebar-header-col-right {
        float: right;
    }

    .sidebar-wrap {
        height: 100%;
        display: flex;
        flex-direction: column;
        width: 100%;
        position: relative;
        overflow-y: scroll;
        overflow-x: hidden;
        padding-left: 40px;
    }

    .sidebar-header-wrap {
        padding: 30px;
        border-bottom: 1px solid #eee;
    }

    .sidebar__content-block {
        padding-right: 50px;
    }

    .m-container {
        width: 100%;
        display: inline-block;
    }

    .message-page__message-chat--message-from {
        margin-left: 10%;
        border: 1px solid #8e24aa;
        /*width: 100%;*/
        float: right;
        /*display: block;*/

    }

    .message-page__message-chat {
        margin-top: 15px;
    }

    .message-page__message-chat {
        position: relative;
        -webkit-border-radius: 35px;
        -moz-border-radius: 35px;
        -ms-border-radius: 35px;
        -o-border-radius: 35px;
        border-radius: 35px;
        padding: 10px 15px;
    }

    .message-page__message-chat--message-to {
        margin-right: 10%;
        border: 1px solid #fb8c00;
        /*width: 100%;*/
        float: left;
        /*display: block;*/
    }

    .sidebar__footer {
        padding-bottom: 30px;
        padding-top: 30px;
        text-align: left;
        padding-left: 40px;
    }

    .sidebar-area {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .sidebar__top {
        position: absolute;
        width: inherit;
    }

    .sidebar__footer {
        padding-bottom: 30px;
        padding-top: 30px;
        text-align: left;
    }



</style>


