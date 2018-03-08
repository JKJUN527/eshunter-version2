@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['title'=> '注册帐号','buttonLeft'=>true])
    <div class="esh-layout__header-tabs">
        <div class="mdl-tabs mdl-js-tabs">
            <div class="mdl-tabs__tab-bar">
                <a data-target="phone" href="#phone" class="mdl-tabs__tab esh-width--1-2 is-active">手机注册</a>
                <a data-target="email" href="#email" class="mdl-tabs__tab esh-width--1-2">邮箱注册</a>
            </div>
            <div id="phone"></div>
            <div id="email"></div>
        </div>
    </div>
@stop

@section('esh-content')
        <div class="mdl-card esh-margin--top-30 esh-width--1-1">

            <div class="mdl-card__actions esh-padding--x-16">
                <form class="esh-form">
                    <div class="esh-form-group">
                        <div class="esh-form-input">
                            <input type="text" id="account" placeholder="请输入手机号…"/>
                        </div >
                        <div class="esh-form-input esh-form-verify">
                            <input type="text" class="" placeholder="请输入验证码…" id="verifyCode"/>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                发送验证码</button>
                        </div>

                        <div class="esh-form-input">
                            <input type="password"  placeholder="请输入密码…" id="registerPwd1"/>
                        </div>
                        <div class="esh-form-input esh-last">
                            <input type="password" placeholder="请确认密码…" id="registerPwd2"/>
                        </div>

                    </div>
                    <div class="esh-reg-type">
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="person">
                            <input type="radio" id="person" class="mdl-radio__button" name="options" value="1" checked>
                            <span class="mdl-radio__label">个人注册</span>
                        </label>
                        &nbsp;&nbsp;
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="company">
                            <input type="radio" id="company" class="mdl-radio__button" name="options" value="2">
                            <span class="mdl-radio__label">企业注册</span>
                        </label>
                    </div>
                    <div class="esh-agreement">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="agreement">
                            <input type="checkbox" id="agreement" value="agreement" class="mdl-checkbox__input">
                            <span class="mdl-checkbox__label">我已阅读并同意<a class="esh-js-user-agreement mdl-color-text--blue" href="#">用户协议</a></span>
                        </label>
                    </div>

                    <div class="esh-form-footer esh-form__actions">
                        <span id="errorMsg" class="esh-msg__error"></span>
                        <div class="esh-form-sure  esh-margin--bottom-5">
                            <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">立即注册</button>
                        </div>
                        <div class="esh-padding--y-10 mdl-typography--text-right">已经有账号了？
                            <a class=" mdl-color-text--blue" href="/m/account/login">立即登录</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@stop

@section('esh-footer')
    <div id="esh-user-agreement" class="esh-dialog__container">
        <div class="mdl-dialog esh-dialog">
            <h4 class="mdl-dialog__title">用户协议</h4>
            <div class="mdl-dialog__content">
                <h6>（一）版权</h6>
                &nbsp;&nbsp;此网站的内容、图表、版式设计等所呈现出的全部或部分可单独作为作品保护之内容等及维系本网站运营的各种源代码、执行程序、系统均受到中国版权法律、法规及相关国际条约的保护。eshunter.com拥有一切权利，未经eshunter.com同意，不允许全部或部分复制、转载或以其他任何方式使用。禁止以任何目的重新使用eshunter.com网上的内容和图表等作品或作品元素。在内容和图表等作品、元素不作任何修改、保留内容未做修改以及事先得到eshunter.com的许可的情况下，eshunter.com的网上材料可作为网外信息方面和非商业方面的用途。经eshunter.com同意后复制、转载或者以其他形式使用本网站相关资料的，应当标明资料来源于“eshunter.com”，以及eshunter.com或相关第三方拥有该等资料的著作权的字样。
                申请使用eshunter.com内容的许可是按逐个批准的原则进行的。eshunter.com欢迎使用者提出申请。请把请求直接提交给kefu@eshunter.com。请勿复制或采用eshunter.com所创造的用以制成网页的HTML。HTML的版权同样属于eshunter.com。
                eshunter.com对其网址上的所有图标、图饰、图表、色彩、文字表述及其组合、版面设计、数据库均享有完全的著作权及其衍生的其他全部权利，对发布的信息均享有专有的发布和使用权。
                <h6>（二）商标</h6>
                eshunter.com的商标属于eshunter.com所有。eshunter.com上的eshunter.com合作者的商标属于合作者所有。未经eshunter.com及/或eshunter.com合作者事先书面许可，不得复制或以任何其他方式使用上述商标。
                <h6>（三）注册</h6>
                1、eshunter.com不对除完全民事行为能力人以外的主体开放，任何不具备完全民事行为能力的主体都不是本网站的合格使用者；eshunter.com有权采取包括但不限于注销账户的处理措施，并向使用者的监护人或负责人索偿。
                2、使用者应自行负责用户名、登录密码、支付密码（如有）、验证码的安全。使用者应对通过使用者账户和密码实施的行为负责，不得将上述信息提供给任何第三方使用或从事任何可能使用户名、密码存在泄露危险的行为（包括但不限于授权代理或第三方网站登录）。因此所衍生的任何损失或损害，eshunter.com不承担任何责任，并保留向使用者追偿的权利。
                3、当使用者发现任何账户的不当使用或有任何其他可能危及账户安全的情形时，应立即告知eshunter.com。使用者理解并知悉eshunter.com采取行动需要合理时间，eshunter.com对在采取行动前已经产生的后果（包括但不限于使用者的任何损失）不承担任何责任。
                4、使用者了解并知悉一经注册，即视为您同意eshunter.com及/或其关联公司通过短信或者电子邮件的方式向使用者的手机号码或者电子邮箱发送相应的产品服务信息、促销优惠等营销信息。
                <h6>(四)网站使用</h6>
                1、明确的禁止使用eshunter.com 只能用于合法目的，即个人寻找职业和雇主寻找雇员。eshunter.com 明确禁止任何其他用途，并要求所有使用者同意不用于下列任何一种用途：
                （1）在简历中心公布不完整、虚假或不准确的简历资料，或不是使用者的准确简历(而为他人寻找全职或兼职工作)。
                （2）公布不是简历的资料，如意见、通知、商业广告或其他非简历内容。
                （3）为eshunter.com的竞争同行回应职位，并用此方法寻求与雇主联络业务。
                （4）除发布者外，删除或修改其他个人或公司公布的资料。
                （5）擅自打印、复制或以其他方式使用有关雇员的任何个人资料或有关雇主的商业信息。
                （6）未经同意，给公布信息的个人或公司发电子邮件、打电话、寄信或以其他方式进行接触。

                2、网址安全法规禁止使用者破坏或企图破坏 eshunter.com 的安全法规，包括但不限于：
                （1）接触未经许可的数据或进入未经许可的服务器、帐户、邮箱或许可第三方接入未经本网站同意的由本网站发布、输送、传播的数据、简历或其他信息等；
                （2）没有得到许可，企图探查、扫描或测试系统或网络的弱点或者破坏安全措施；
                （3）企图干涉对用户及网络的服务，包括但不限于通过超载、“邮件炸弹”或“摧毁”等手段；
                （4）发送促销、产品广告及服务的email；
                （5）伪造TCP/IP数据包名称或部分名称。破坏系统或网络可能导致犯罪。eshunter.com 将调查此类破坏行为的发生，并可能干预、和执法当局合作起诉犯此类破坏行为的使用者。
                3、总则严禁从事以下行为：
                （1）违反任何现行法律法规及其不时的修订；
                （2）侵犯他人的版权、商业机密、或其他知识产权，或侵犯了他人的隐私权、出版权或其他个人合法权利；
                （3）利用本网站传送、分发、储存属于诽谤、淫秽、威胁、辱骂性、毁损他人或其他非法或者违反社会公序良俗的材料；
                （4）利用本网站提供的服务系统进行任何可能对互联网或移动网正常运转造成不利影响的行为；
                （5）以任何形式使用本网站提供的服务进行任何不利于本网站的行为。
                <h6>(五)暂停使用、终止使用</h6>
                任何一位使用者经 eshunter.com 确定已违反了网站使用规则某一项规定，将有可能收到一份书面警告。如果该使用者同意以书面形式表示自己再也不会有违犯行为，eshunter.com 有权决定是否给予暂停使用或终止使用的处理。然而，如果我们认为必要时，也可不提出警告而马上暂停或终止对该使用者的服务。如果我们确定某一使用者再次违犯了网络使用规则的任何一项规定，无需再发通知，该使用者立即受到暂停使用或终止使用的处理。
                <h6>（六）免责条款</h6>
                1、使用者理解并同意eshunter.com对以下情况免责：（1）应聘信息发布方对存入简历中心的个人简历及材料的格式、内容的真实性、准确性和合法性负有全部责任，招聘信息发布方对于其在职位数据库公布的材料的真实性、准确性和合法性负有全部责任。eshunter.com仅是提供职位发布等信息的平台，eshunter.com不对应聘及招聘信息的真实性、有效性、准确性负责。
                （2）eshunter.com并不能时时监视此网址，但保留进行随时监视的权利。对于非eshunter.com公布的材料，eshunter.com一概不负任何责任。
                （3）eshunter.com虽然对用户进行资质审查，但eshunter.com并非司法机关，仅能要求用户提交真实、有效的资质证明文件，并对该提交的资质证明文件进行审核。如用户提交虚假、伪造、变造文件的，eshunter.com对此概不承担法律责任。
                （4）eshunter.com不对用户的线下行为负责。企业用户及个人用户均应审慎的对待他方之行为，因为他方之行为给用户造成任何不利影响的，eshunter.com不承担任何法律责任。
                （5）eshunter.com不能保证某一种职位描述会有一定数目的使用者来浏览，也不能保证会有一位特定的使用者来浏览。
                （6）eshunter.com对由于政府禁令、现行生效的适用法律或法规的变更、火灾、地震、动乱、战争、停电、通讯线路中断、黑客攻击、计算机病毒侵入或发作、电信部门技术调整、因政府管制而造成网站的暂时性关闭等任何影响网络正常运营的不可预见、不可避免、不可克服和不可控制的事件（“不可抗力事件”），以及他人蓄意破坏、eshunter.com工作人员的疏忽或不当使用，正常的系统维护、系统升级，或者因网络拥塞而导致本网站不能访问而造成的本网站所提供的信息及数据的延误、停滞或错误，以及使用者由此受到的一切损失不承担任何责任。
                （7）由于与本网站链接的其他网站或用户所使用的网络运营商所造成之个人资料泄露及由此而导致的任何法律争议和后果均由网站或用户所使用的网络运营商负责；
                （8）对于eshunter.com为使用者提供便利而设置的外部链接网址，eshunter.com并不保证其准确性、安全性和完整性，亦并不代表本网站对其链接内容的认可，请使用者谨慎确认后使用，eshunter.com对由此导致的任何损失或伤害不承担任何责任。
                2、除了本网址在隐私政策中提出的条款外，使用者理解并同意eshunter.com在不公开姓名的情况下，可以向第三方提供综合性的非个人化信息资料。除非：（1）依照法律、法规、法院命令、监管机构命令的要求；
                （2）根据政府行为、监管要求或请求；
                （3）因eshunter.com其认为系为遵守监管义务或公共目的所需；
                （4）为免除访问者在生命、身体或财产方面之急迫危险，
                否则在没有本人事先同意的情况下，eshunter.com 不会向第三方公开你的姓名、地址、电子邮件和电话等个人信息。
                <h6>(七)风险声明</h6>
                你使用本网址将自行承担风险。本网址的材料是按“正如……的情况”所提供的，对材料不作明显的或暗含的保证。除非适用的法律法规有明确规定，eshunter.com 及其所属网络对销售性的和适合于某一特定目的的一切保证不予承认。 eshunter.com 不能保证材料的特殊目的不受阻挠不出错误，也不能保证错误会得到纠正，也不能保证本网址或制成本网址的材料不含有病毒或其他有害成分。在有关材料的使用或使用结果方面对材料的正确性、准确性、可靠性或其他方面，eshunter.com 不作出保证或任何说明。你（而不是 eshunter.com ）承担一切必要的服务、修理或改正费用。在适用法规不允许暗含保证可免除承担一切费用的范围里，免除上述承担费用不适用于你。
                警告
                在使用 eshunter.com 网络时违背了这些法规将构成对eshunter.com权利的侵犯或违反，并可导致对你采取法律行动。
            </div>
            <div class="mdl-dialog__actions">
                <button class="mdl-button esh-dialog__button-close">我知道了</button>
            </div>
        </div>
    </div>
@stop


@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/my/register.js')}}"></script>
    @stop