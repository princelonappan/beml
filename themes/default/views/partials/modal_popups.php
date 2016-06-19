<div class="modal" id="forgotPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo image_url('close.png'); ?>" class="close" data-dismiss="modal" aria-hidden="true"/>
                <h4 class="modal-title">Forgot Password</h4>
            </div>
            <div class="modal-body">
                <form id="forgot-password-form" action="" method="post">
                    <p>
                        To retrieve your password, please enter your email here.</p>

                    <div class="row">

                        <div class="col-lg-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <label>Email*</label>
                        </div>
                        <div class="col-lg-9 col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <div class="form-group">
                                <input name="forgot_email" type="text"/>
                                <span class="validation"></span>
                            </div>
                        </div>

                    </div>
                    <img style="display: none;" class="loader forgot_loader"
                         src="<?php echo image_url('loader.gif'); ?>">
                </form>
                <div id="forgot-message" class="alert alert-success no-display" role="alert"></div>
            </div>

            <div class="modal-footer">
                <div class="bar-submit">
                    <p>
                        <a href="" id="forgot-form-done" class="btn btn-primary btn-lg">Done</a>
                        <a href="" id="forgot-form-cancel" class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
                    </p>
                </div>


            </div>
        </div>
    </div>
</div>
<div class="modal" id="terms-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo image_url('close.png'); ?>" class="close" data-dismiss="modal" aria-hidden="true"/>
                <h4 class="modal-title">Terms And Conditions</h4>
            </div>
            <div class="modal-body">
                <div class="eq_bicolumn fl_left termsC">

                    <p>Welcome to Preschool2me! By using Preschool2me's software, mobile applications or web sites, you agree to the following terms and conditions (herein referred to as “T&amp;C document”)conditions (herein referred to as “T&amp;C document”) as dictated by Daycare2me Inc, (herein referred to as “we”, “us”, “our”, “Company”), and any policies, guidelines or amendments thereto that may be presented to you from time to time. We may update this T&amp;C documents in the future, and you will be able to find the most current version of this T&amp;C document at&nbsp;<a href="http://www.preschool2me.com/users/terms.html" target="_blank" style="color: #FFA200;">http://www.preschool2me.com/users/terms.html.</a></p>
                    <label>1. Your relationship with us.</label>
                    <p>Below are the terms and conditions that are applicable to end users (this includes pre-school administrators, owners, teachers and parents, and shall be referred to herein as “you”, “your”, or “Customer”) who choose to access our website, mobile application and support (collectively termed as “Preschool2me Services”). By utilizing our Preschool2me Services, you agree to be bound by this T&amp;C document. To cancel your account, contact us at <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=talk2us@preschool2me.com" target="_blank" style="color: #FFA200;">talk2us@preschool2me.com</a>. The Preschool2me Services are provided on a subscription basis to some
                        users and for free to other users, and are licensed, NOT sold, and none
                        of our intellectual property or rights, other than those explicitly stated
                        herein are transferred or sold under this or any other agreement with us.</p>
                    <p> Teachers accessing the Preschool2me Services represent and warrant they are authorized by their employer to access the Services and will only use the Preschool2me Services in accordance with their employer’s
                        guidelines, including only accessing the Services through electronic
                        devices provided by their employer. Teachers will not access the
                        Preschool2me Services through their personal electronic devices.</p>

                    <label>2. Subscription and Fees</label>
                    <p>Details of Subscription and Fees are listed in a separate “Subscription Agreement”. Any discrepancy between the T&amp;C document and the
                        Subscription Agreement, the terms of the Subscription Agreement shall control.</p>
                    <p>We do not charge parents for the use of our Preschool2me Services. However, pre-school owners may choose to charge parents additional fees.</p>
                    <p>By registering to use and using the Services, you agree to provide us with current, complete and accurate information (contact information, email address, etc.). You hereby promise that all the information you
                        provide to us is true and accurate. Any account information (email
                        address, passwords, etc.) should be maintained as confidential by you.
                        You agree to notify us of any theft or unauthorized use of your account
                        information. You agree to not share account information with any third party.</p>

                    <label>3. Privacy and Security (use of images)</label>
                    <p>Preschool2me Services captures and stores child information (pictures, name, parent’s name and email), pre-school information (name, contact information) and teacher information (Teacher’s name and authorized email address) only. All of this information is collected
                        and stored in accordance with the representation and warranties set forth below. We will NOT use child captured information now or in future for any purpose other than the provision of the Preschool2me Services (including newsletters, emails, periodic updates etc.). We may
                        contact pre-school owners for surveys, future releases, feedback and newsletters.</p>
                    <p>Parents may close their account or request any child information be removed from our systems by emailing us at <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=talk2us@preschool2me.com" target="_blank" style="color: #FFA200;">talk2us@preschool2me.com.</a></p>

                    <label>4. Disclaimer of Warranties</label>
                    <p>PRESCHOOL2ME SERVICES PROVIDED UNDER THIS T&amp;C DOCUMENT, OR BY US UNDER ANY OTHER AGREEMENT ARE PROVIDED ON AN “AS IS” AND “AS AVAILABLE” BASIS FOR USE. THESE PRESCHOOL2ME SERVICES ARE PROVIDED WITHOUT WARRANTIES OR CONDITIONS, EITHER EXPRESSED OR IMPLIED. THIS INCLUDES BUT IS NOT LIMITED TO THE WARRANTIES OF FITNESS FOR A PARTICULAR PURPOSE, AND THOSE ARISING FROM COURSE OF DEALING OR USAGE OF TRADE. WE DO NOT WARRANT THAT YOU WILL BE ABLE TO ACCESS OR USE THE PRESCHOOL2ME SERVICES AT TIMES OR LOCATIONS OF YOUR CHOOSING.</p>
                    <p>Notwithstanding the foregoing, we represent and warrant the following:</p>
                    <label>Server Setup:</label>
                    <p>1. Daycare2me’s application server and database server will be hosted on an Amazon Cloud environment, or an equivalent recognizable and trustworthy third party environment, as applicable.</p>
                    <p>2. Daycare2me shall maintain separate webserver and database servers for their data and application platforms.</p>
                    <p>3. Daycare2me shall take all reasonable measures to ensure that all ports are blocked so access to the database server is only possible from the webserver; other than the webserver there shall be no external application that can access the database.</p>
                    <p>4. Daycare2me shall change the root access password at least monthly.</p>
                    <p>5. Daycare2me shall ensure that access to the live environment is limited to system administrator and active Preschool2me owners.</p>
                    <p>6. Daycare2me shall ensure that passwords are encrypted in the database.</p>
                    <p>7. Daycare2me shall ensure that the picture folders are encrypted in the database.</p>
                    <p>8. Daycare2me shall ensure names of the pictures are stored in 40 character (UDID) encrypted code.</p>
                    <p>9. Daycare2me shall ensure that the encryption shall be at least a 256-bit SSL encryption, certified by GODADDY or an equivalent recognizable and trustworthy third party.</p>
                    <p>10.Daycare2me shall use Nagios for constant monitoring and service alerts, or an equivalent recognizable and trustworthy third party.</p>
                    <p>11. In addition to current backup policy, Daycare2me shall ensure that additional backups will be stored on a separate secured server hosted on an Amazon Cloud environment.</p>
                    <p>12.Daycare2me shall ensure code migration will be done solely by Preschool2me’s founder and system administrator.</p>
                    <p>13.Daycare2me shall ensure that reasonable vulnerability scans and penetration testing (DDoS, BruteForce, OWASP top 10, SANS top 25, Mitre CWE's) are performed on at least a quarterly basis.</p>
                    <p>14.Daycare2me will not ask for or save student health information (medications, allergy etc.).</p>
                    <label>Parent App Security:</label>
                    <p>1. Daycare2me shall ensure that the App users will utilize strong passwords.</p>
                    <p>2. Daycare2me shall ensure that it will have additional layers of security for password recovery – namely the utilization of a security questions and 4-digit PIN to reset the password.</p>
                    <p>3. Daycare2me shall ensure that if parent cannot provide answers to security questions and PIN, Daycare2me will be able to reset account/password.</p>
                    <p>4. Daycare2me shall ensure the App shall request a PIN every ‘x’ minutes from parents in order to prevent unauthorized access. Parents have the option of setting this ‘x’ to either 5, 10 or 15 minutes.</p>
                    <p>Daycare2me warrants and represents that the above shall be the minimum security and privacy measures that it will take as it relates to the parent App security. Nevertheless, Daycare2me reserves the right to change these measures at their discretion, provided that it will not take any measures that shall unreasonably compromise the security and privacy of the App, and that changed measures shall be substantially similar to the aforementioned measures.</p>
                    <p>Daycare2me warrants and affirms that it will comply with any and all state or federal laws related to non-public information or privacy related matters.</p>

                </div>
            </div>

            <div class="modal-footer">
                <div class="bar-submit">
                    <p>
                        <a href="" id="forgot-form-cancel" class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
                    </p>
                </div>


            </div>
        </div>
    </div>
</div>
<div class="modal" id="privacy-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo image_url('close.png'); ?>" class="close" data-dismiss="modal" aria-hidden="true"/>
                <h4 class="modal-title">Privacy</h4>
            </div>
            <div class="modal-body">


                    <p>Welcome to Preschool2me! Use of Preschool2me’s software, mobile applications, or web sites ("Preschool2me services") may require personal and private information about pre-school owners, parents, teachers and children. Please find below the Privacy policies that are applicable to end users (pre-school administrators, owners, teachers, parents and legal guardians, herein referred to as “you”, “your”, “Customer”) who choose to access Daycare2me Inc’s (herein referred to as “we”, “us”, “our”, “Company”) Preschool2me services. We may update this Privacy Policy in the future, and you will be able to find the most current version of this document at <a href="http://www.preschool2me.com/users/privacy.html" target="_blank" style="color: #FFA200;">http://www.preschool2me.com/users/privacy.html.</a></p>
                    <label>1. Contacting us</label>
                    <p>Daycare2me Inc.<br>
                        1448 Chandler Avenue NW<br>
                        Concord, NC 28027<br>
                        <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=talk2us@preschool2me.com" target="_blank" style="color: #FFA200;">talk2us@preschool2me.com.</a><br>
                        980.272.1866</p>
                    <label>2. Collected and Stored Information</label>
                    <p>As a result of using the Preschool2me services, we capture information related to you and your children (pictures, names, and email), school information (name, contact information) and teacher information (name and email address) only. All of this information is transmitted using 256-bit SSL security.</p>
                    <p>Information we capture is used to provide the Preschool2me services and customize the content to your individual preferences (like lesson plans, photo restrictions, etc.). We may also use this information to send periodic communication (emails, newsletters and app updates) related to Preschool2me services. Any information captured from you, the school, or the teachers is only shared with you, and your approved parties, through your approved email address associated with your account.</p>
                    <p style="margin-top:-7px;">We will NOT use the information we collect now or in future for any purposes other than the services related to or provided by the Preschool2me app. We may contact you in order to inform you of software updates. We will not share captured information with any third party or any external entity. We may contact pre-school owners for surveys, future releases, feedback and newsletters.</p>
                    <p>Collected and stored information may be shared with the franchisor on an “as needed” or “when requested” basis.</p>

                    <label>3. Consent to collect information</label>
                    <p>We obtain explicit consent from you before allowing you to login to Preschool2me services. Childcare centers (Preschools, Daycare centers etc.) may notify you of Preschool2me services.</p>

                    <label>4. Refusal from Parents or Legal Guardians</label>
                    <p>You may close your account or request that information be removed from our systems by contacting us at <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=talk2us@preschool2me.com" target="_blank" style="color: #FFA200;">talk2us@preschool2me.com.</a></p>

                    <label>5. Business Transitions</label>
                    <p>In the event that we go through a business transition (merger, acquisition or sale), you will be notified via prominent notice on our website prior to a change of ownership or control of personal information. Before the date of transition, if a parent/school wants to discontinue with Preschool2me services they can do so by contacting us using one of the methods outlined in section 1 above.</p>

                    <label>6. Notification of Changes</label>
                    <p>We may amend this Privacy Policy from time to time. If we make any changes to this Privacy Policy document, we will alert of these changes and require you to provide your explicit consent to continue to use Preschool2me services, even if consent was provided earlier.</p>

                    <p>7. We do not permit children under the age of 13 the ability to access, post, or otherwise distribute personal information through Preschool2me app or website. We will comply with any state or federal laws related to non-public information or privacy related matters, but if you want to opt out of any of the Preschool2me services contact us at the information provided above.</p>

            </div>

            <div class="modal-footer">
                <div class="bar-submit">
                    <p>
                        <a href="" id="forgot-form-cancel" class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
                    </p>
                </div>


            </div>
        </div>
    </div>
</div>

