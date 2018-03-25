<?php defined("BASEPATH") OR exit("No direct script access allowed");

                require(APPPATH."/libraries/REST_Controller.php");

class Volunteer extends REST_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model("volunteer_model");
            #__construct#
        }
        public function index_get()
        {
            //$this->load->view("service/admin_view");
        }
        #:-1-:##start
        function add_post()
        {
            $response   = $this->volunteer_model->volunteer_add();
            $this->response( $response );
        }
        #:-1-:##end
        function update_post()
        {
            $response   = $this->volunteer_model->volunteer_update();
            $this->response( $response );
        }                 
        #:--:##start
        function update_ad_status_post()
        {
            $response   = $this->Admin_model->update_ad_status();
            $this->response( $response );
        }
        #:--:##end

        
        #:-2-:##start
        function get_ad_list_post()
        {
            $response   = $this->Admin_model->get_ad_list();
            $this->response( $response );
        }
        #:-2-:##end

        
        #:-3-:##start
        function get_ad_details_post()
        {
            $response   = $this->Admin_model->get_ad_details();
            $this->response( $response );
        }
        #:-3-:##end

        
        #:-4-:##start
        function update_ad_post()
        {
            $response   = $this->Admin_model->update_ad();
            $this->response( $response );
        }
        #:-4-:##end

        
        #:-5-:##start
        function insert_ad_post()
        {
            $response   = $this->Admin_model->insert_ad();
            $this->response( $response );
        }
        #:-5-:##end

        
        #:-6-:##start
        function delete_ad_post()
        {
            $response   = $this->Admin_model->delete_ad();
            $this->response( $response );
        }
        #:-6-:##end

        #:--:##start
        function delete_association_post()
        {
            $response   = $this->Admin_model->delete_association();
            $this->response( $response );
        }
        #:--:##end

        #:--:##start
        function update_association_status_post()
        {
            $response   = $this->Admin_model->update_association_status();
            $this->response( $response );
        }
        #:--:##end


        #:-7-:##start
        function get_associations_dt_list_post()
        {
            $response   = $this->Admin_model->get_associations_dt_list();
            $this->response( $response );
        }
        #:-7-:##end

        
        #:-8-:##start
        function insert_association_post()
        {
            $response   = $this->Admin_model->insert_association();
            $this->response( $response );
        }
        #:-8-:##end

        
        #:-9-:##start
        function update_association_post()
        {
            $response   = $this->Admin_model->update_association();
            $this->response( $response );
        }
        #:-9-:##end

        
        #:-10-:##start
        function get_association_list_post()
        {
            $response   = $this->Admin_model->get_association_list();
            $this->response( $response );
        }
        #:-10-:##end

        #:--:##start
        function get_association_details_post()
        {
            $response   = $this->Admin_model->get_association_details();
            $this->response( $response );
        }
        #:--:##end
        
        #:-11-:##start
        function get_category_dt_list_post()
        {
            $response   = $this->Admin_model->get_category_dt_list();
            $this->response( $response );
        }
        #:-11-:##end

        
        #:-12-:##start
        function get_category_list_post()
        {
            $response   = $this->Admin_model->get_category_list();
            $this->response( $response );
        }
        #:-12-:##end
        #:-12-:##start
        function get_category_details_post()
        {
            $response   = $this->Admin_model->get_category_details();
            $this->response( $response );
        }
        #:-12-:##end
        
        #:-13-:##start
        function insert_category_post()
        {
            $response   = $this->Admin_model->insert_category();
            $this->response( $response );
        }
        #:-13-:##end

        
        #:-14-:##start
        function update_category_post()
        {
            $response   = $this->Admin_model->update_category();
            $this->response( $response );
        }
        #:-14-:##end

        
        #:-15-:##start
        function delete_category_post()
        {
            $response   = $this->Admin_model->delete_category();
            $this->response( $response );
        }
        #:-15-:##end

        
        #:-16-:##start
        function get_country_dt_list_post()
        {
            $response   = $this->Admin_model->get_country_dt_list();
            $this->response( $response );
        }
        #:-16-:##end

        
        #:-17-:##start
        function get_country_list_post()
        {
            $response   = $this->Admin_model->get_country_list();
            $this->response( $response );
        }
        #:-17-:##end

        
        #:-18-:##start
        function insert_country_post()
        {
            $response   = $this->Admin_model->insert_country();
            $this->response( $response );
        }
        #:-18-:##end

        
        #:-19-:##start
        function update_country_post()
        {
            $response   = $this->Admin_model->update_country();
            $this->response( $response );
        }
        #:-19-:##end

        
        #:-20-:##start
        function delete_country_post()
        {
            $response   = $this->Admin_model->delete_country();
            $this->response( $response );
        }
        #:-20-:##end

        
        #:-21-:##start
        function update_country_status_post()
        {
            $response   = $this->Admin_model->update_country_status();
            $this->response( $response );
        }
        #:-21-:##end

        
        #:-22-:##start
        function update_category_status_post()
        {
            $response   = $this->Admin_model->update_category_status();
            $this->response( $response );
        }
        #:-22-:##end

        #:--:##start
        function generate_coupon_code_post()
        {
            $response   = $this->Admin_model->generate_coupon_code();
            $this->response( $response );
        }
        #:--:##end
        

         #:-23-:##start
        function get_coupon_code_dt_list_post()
        {
            $response   = $this->Admin_model->get_coupon_code_dt_list();
            $this->response( $response );
        }
        #:-23-:##end

        
        #:-24-:##start
        function get_coupon_code_details_post()
        {
            $response   = $this->Admin_model->get_coupon_code_details();
            $this->response( $response );
        }
        #:-24-:##end

        
        #:-25-:##start
        function update_coupon_code_post()
        {
            $response   = $this->Admin_model->update_coupon_code();
            $this->response( $response );
        }
        #:-25-:##end

        
        #:-26-:##start
        function update_coupon_code_status_post()
        {
            $response   = $this->Admin_model->update_coupon_code_status();
            $this->response( $response );
        }
        #:-26-:##end

        
        #:-27-:##start
        function get_email_template_dt_list_post()
        {
            $response   = $this->Admin_model->get_email_template_dt_list();
            $this->response( $response );
        }
        #:-27-:##end
        #:-27-:##start
        function get_email_template_details_post()
        {
            $response   = $this->Admin_model->get_email_template_details();
            $this->response( $response );
        }
        #:-27-:##end

        
        #:-28-:##start
        function get_email_template_list_post()
        {
            $response   = $this->Admin_model->get_email_template_list();
            $this->response( $response );
        }
        #:-28-:##end

        
        #:-29-:##start
        function insert_email_template_post()
        {
            $response   = $this->Admin_model->insert_email_template();
            $this->response( $response );
        }
        #:-29-:##end

        
        #:-30-:##start
        function update_email_template_post()
        {
            $response   = $this->Admin_model->update_email_template();
            $this->response( $response );
        }
        #:-30-:##end

        
        #:-31-:##start
        function update_email_template_status_post()
        {
            $response   = $this->Admin_model->update_email_template_status();
            $this->response( $response );
        }
        #:-31-:##end

        
        #:-32-:##start
        function delete_email_template_post()
        {
            $response   = $this->Admin_model->delete_email_template();
            $this->response( $response );
        }
        #:-32-:##end

        
        #:-33-:##start
        function get_languages_dt_list_post()
        {
            $response   = $this->Admin_model->get_languages_dt_list();
            $this->response( $response );
        }
        #:-33-:##end

        
        #:-34-:##start
        function get_languages_list_post()
        {
            $response   = $this->Admin_model->get_languages_list();
            $this->response( $response );
        }
        #:-34-:##end

        #:--:##start
        function get_language_details_post()
        {
            $response   = $this->Admin_model->get_language_details();
            $this->response( $response );
        }
        #:--:##end
        
        #:-35-:##start
        function insert_language_post()
        {
            $response   = $this->Admin_model->insert_language();
            $this->response( $response );
        }
        #:-35-:##end

        
        #:-36-:##start
        function update_language_post()
        {
            $response   = $this->Admin_model->update_language();
            $this->response( $response );
        }
        #:-36-:##end

        
        #:--:##start
        function delete_language_post()
        {
            $response   = $this->Admin_model->delete_language();
            $this->response( $response );
        }
        #:--:##end
        
        #:-37-:##start
        function update_language_status_post()
        {
            $response   = $this->Admin_model->update_language_status();
            $this->response( $response );
        }
        #:-37-:##end

        
        #:-38-:##start
        function get_movies_dt_list_post()
        {
            $response   = $this->Admin_model->get_movies_dt_list();
            $this->response( $response );
        }
        #:-38-:##end

        
        #:-39-:##start
        function get_movies_list_post()
        {
            $response   = $this->Admin_model->get_movies_list();
            $this->response( $response );
        }
        #:-39-:##end

        
        #:-40-:##start
        function insert_movie_post()
        {
            $response   = $this->Admin_model->insert_movie();
            $this->response( $response );
        }
        #:-40-:##end

        
        #:-41-:##start
        function update_movie_post()
        {
            $response   = $this->Admin_model->update_movie();
            $this->response( $response );
        }
        #:-41-:##end

        
        #:-42-:##start
        function update_movie_status_post()
        {
            $response   = $this->Admin_model->update_movie_status();
            $this->response( $response );
        }
        #:-42-:##end

        
        #:-43-:##start
        function insert_movie_ad_post()
        {
            $response   = $this->Admin_model->insert_movie_ad();
            $this->response( $response );
        }
        #:-43-:##end

        
        #:-44-:##start
        function update_movie_ad_post()
        {
            $response   = $this->Admin_model->update_movie_ad();
            $this->response( $response );
        }
        #:-44-:##end

        
        #:-45-:##start
        function update_movie_ad_status_post()
        {
            $response   = $this->Admin_model->update_movie_ad_status();
            $this->response( $response );
        }
        #:-45-:##end

        
        #:-46-:##start
        function insert_movie_play_post()
        {
            $response   = $this->Admin_model->insert_movie_play();
            $this->response( $response );
        }
        #:-46-:##end

        
        #:-47-:##start
        function update_movie_play_post()
        {
            $response   = $this->Admin_model->update_movie_play();
            $this->response( $response );
        }
        #:-47-:##end

        
        #:-48-:##start
        function get_movie_play_dt_list_post()
        {
            $response   = $this->Admin_model->get_movie_play_dt_list();
            $this->response( $response );
        }
        #:-48-:##end

        
        #:-49-:##start
        function insert_movie_trailer_post()
        {
            $response   = $this->Admin_model->insert_movie_trailer();
            $this->response( $response );
        }
        #:-49-:##end

        
        #:-50-:##start
        function update_movie_trailer_post()
        {
            $response   = $this->Admin_model->update_movie_trailer();
            $this->response( $response );
        }
        #:-50-:##end

        
        #:-51-:##start
        function get_movie_trailer_list_post()
        {
            $response   = $this->Admin_model->get_movie_trailer_list();
            $this->response( $response );
        }
        #:-51-:##end

        
        #:-52-:##start
        function get_movie_trailer_dt_list_post()
        {
            $response   = $this->Admin_model->get_movie_trailer_dt_list();
            $this->response( $response );
        }
        #:-52-:##end

        
        #:-53-:##start
        function insert_otp_post()
        {
            $response   = $this->Admin_model->insert_otp();
            $this->response( $response );
        }
        #:-53-:##end

        
        #:-54-:##start
        function update_otp_status_post()
        {
            $response   = $this->Admin_model->update_otp_status();
            $this->response( $response );
        }
        #:-54-:##end

        
        #:-55-:##start
        function get_otp_list_post()
        {
            $response   = $this->Admin_model->get_otp_list();
            $this->response( $response );
        }
        #:-55-:##end

        
        #:-56-:##start
        function get_otp_dt_list_post()
        {
            $response   = $this->Admin_model->get_otp_dt_list();
            $this->response( $response );
        }
        #:-56-:##end

        
        #:-57-:##start
        function get_otp_details_post()
        {
            $response   = $this->Admin_model->get_otp_details();
            $this->response( $response );
        }
        #:-57-:##end

        
        #:-58-:##start
        function insert_player_config_post()
        {
            $response   = $this->Admin_model->insert_player_config();
            $this->response( $response );
        }
        #:-58-:##end

        
        #:-59-:##start
        function update_player_config_post()
        {
            $response   = $this->Admin_model->update_player_config();
            $this->response( $response );
        }
        #:-59-:##end

        
        #:-60-:##start
        function get_player_config_list_post()
        {
            $response   = $this->Admin_model->get_player_config_list();
            $this->response( $response );
        }
        #:-60-:##end

        
        #:-61-:##start
        function insert_promotion_post()
        {
            $response   = $this->Admin_model->insert_promotion();
            $this->response( $response );
        }
        #:-61-:##end

        
        #:-62-:##start
        function update_promotion_post()
        {
            $response   = $this->Admin_model->update_promotion();
            $this->response( $response );
        }
        #:-62-:##end

        
        #:-63-:##start
        function get_promotion_dt_list_post()
        {
            $response   = $this->Admin_model->get_promotion_dt_list();
            $this->response( $response );
        }
        #:-63-:##end
        
        #:-64-:##start
        function get_promotion_details_post()
        {
            $response   = $this->Admin_model->get_promotion_details();
            $this->response( $response );
        }
        #:-64-:##end
        
        #:-65-:##start
        function delete_promotion_post()
        {
            $response   = $this->Admin_model->delete_promotion();
            $this->response( $response );
        }
        #:-65-:##end

        
        #:-66-:##start
        function delete_movie_post()
        {
            $response   = $this->Admin_model->delete_movie();
            $this->response( $response );
        }
        #:-66-:##end

        
        #:-67-:##start
        function delete_movie_ad_post()
        {
            $response   = $this->Admin_model->delete_movie_ad();
            $this->response( $response );
        }
        #:-67-:##end

        
        #:-68-:##start
        function delete_movies_play_post()
        {
            $response   = $this->Admin_model->delete_movies_play();
            $this->response( $response );
        }
        #:-68-:##end

        
        #:-69-:##start
        function delete_movies_trailers_post()
        {
            $response   = $this->Admin_model->delete_movies_trailers();
            $this->response( $response );
        }
        #:-69-:##end

        
        #:-70-:##start
        function delete_otp_post()
        {
            $response   = $this->Admin_model->delete_otp();
            $this->response( $response );
        }
        #:-70-:##end

        
        #:-71-:##start
        function delete_quiz_post()
        {
            $response   = $this->Admin_model->delete_quiz();
            $this->response( $response );
        }
        #:-71-:##end

        
        #:-72-:##start
        function insert_quiz_post()
        {
            $response   = $this->Admin_model->insert_quiz();
            $this->response( $response );
        }
        #:-72-:##end

        
        #:-73-:##start
        function update_quiz_post()
        {
            $response   = $this->Admin_model->update_quiz();
            $this->response( $response );
        }
        #:-73-:##end

        
        #:-74-:##start
        function get_quiz_dt_list_post()
        {
            $response   = $this->Admin_model->get_quiz_dt_list();
            $this->response( $response );
        }
        #:-74-:##end
        #:-74-:##start
        function get_quiz_details_post()
        {
            $response   = $this->Admin_model->get_quiz_details();
            $this->response( $response );
        }
        #:-74-:##end
        #:-74-:##start
        function update_quiz_status_post()
        {
            $response   = $this->Admin_model->update_quiz_status();
            $this->response( $response );
        }
        #:-74-:##end   
        
        #:-75-:##start
        function get_quiz_list_post()
        {
            $response   = $this->Admin_model->get_quiz_list();
            $this->response( $response );
        }
        #:-75-:##end

        
        #:-76-:##start
        function insert_quiz_answers_post()
        {
            $response   = $this->Admin_model->insert_quiz_answers();
            $this->response( $response );
        }
        #:-76-:##end

        
        #:-77-:##start
        function update_quiz_answers_post()
        {
            $response   = $this->Admin_model->update_quiz_answers();
            $this->response( $response );
        }
        #:-77-:##end

        
        #:-78-:##start
        function get_quiz_answer_details_post()
        {
            $response   = $this->Admin_model->get_quiz_answer_details();
            $this->response( $response );
        }
        #:-78-:##end

        
        #:-79-:##start
        function get_quiz_answer_list_post()
        {
            $response   = $this->Admin_model->get_quiz_answer_list();
            $this->response( $response );
        }
        #:-79-:##end

        
        #:-80-:##start
        function get_quiz_answer_dt_list_post()
        {
            $response   = $this->Admin_model->get_quiz_answer_dt_list();
            $this->response( $response );
        }
        #:-80-:##end

        
        #:-81-:##start
        function delete_quiz_answers_post()
        {
            $response   = $this->Admin_model->delete_quiz_answers();
            $this->response( $response );
        }
        #:-81-:##end

        
        #:-82-:##start
        function get_movie_details_post()
        {
            $response   = $this->Admin_model->get_movie_details();
            $this->response( $response );
        }
        #:-82-:##end

        
        #:-83-:##start
        function insert_setting_post()
        {
            $response   = $this->Admin_model->insert_setting();
            $this->response( $response );
        }
        #:-83-:##end

        
        #:-84-:##start
        function update_setting_post()
        {
            $response   = $this->Admin_model->update_setting();
            $this->response( $response );
        }
        #:-84-:##end

        
        #:-85-:##start
        function get_setting_details_post()
        {
            $response   = $this->Admin_model->get_setting_details();
            $this->response( $response );
        }
        #:-85-:##end

        
        #:-86-:##start
        function delete_state_post()
        {
            $response   = $this->Admin_model->delete_state();
            $this->response( $response );
        }
        #:-86-:##end

        
        #:-87-:##start
        function insert_state_post()
        {
            $response   = $this->Admin_model->insert_state();
            $this->response( $response );
        }
        #:-87-:##end

        
        #:-88-:##start
        function update_state_post()
        {
            $response   = $this->Admin_model->update_state();
            $this->response( $response );
        }
        #:-88-:##end

        
        #:-89-:##start
        function get_state_dt_list_post()
        {
            $response   = $this->Admin_model->get_state_dt_list();
            $this->response( $response );
        }
        #:-89-:##end

        
        #:-90-:##start
        function get_state_list_post()
        {
            $response   = $this->Admin_model->get_state_list();
            $this->response( $response );
        }
        #:-90-:##end
        
        #:-91-:##start
        function get_state_details_post()
        {
            $response   = $this->Admin_model->get_state_details();
            $this->response( $response );
        }
        #:-91-:##end

        #:--:##end
        function get_movie_trailer_details_post()
        {
            $response   = $this->Admin_model->get_movie_trailer_details();
            $this->response( $response );
        }
        #:--:##end

        #:-92-:##start
        function get_movie_ad_details_post()
        {
            $response   = $this->Admin_model->get_movie_ad_details();
            $this->response( $response );
        }
        #:-92-:##end
        #:-93-:##start
        function get_movie_ad_dt_list_post()
        {
            $response   = $this->Admin_model->get_movie_ad_dt_list();
            $this->response( $response );
        }
        #:-93-:##end
        #:-94-:##start
        function get_movie_ad_list_post()
        {
            $response   = $this->Admin_model->get_movie_ad_list();
            $this->response( $response );
        }
        #:-94-:##end

        
        #:-95-:##start
        function insert_user_role_post()
        {
            $response   = $this->Admin_model->insert_user_role();
            $this->response( $response );
        }
        #:-95-:##end

        
        #:-96-:##start
        function update_user_role_post()
        {
            $response   = $this->Admin_model->update_user_role();
            $this->response( $response );
        }
        #:-96-:##end

        
        #:-97-:##start
        function update_user_role_status_post()
        {
            $response   = $this->Admin_model->update_user_role_status();
            $this->response( $response );
        }
        #:-97-:##end

        
        #:-98-:##start
        function delete_user_role_post()
        {
            $response   = $this->Admin_model->delete_user_role();
            $this->response( $response );
        }
        #:-98-:##end

        
        #:-99-:##start
        function get_user_role_dt_list_post()
        {
            $response   = $this->Admin_model->get_user_role_dt_list();
            $this->response( $response );
        }
        #:-99-:##end

        
        #:-100-:##start
        function get_user_role_list_post()
        {
            $response   = $this->Admin_model->get_user_role_list();
            $this->response( $response );
        }
        #:-100-:##end

        
        #:-101-:##start
        function get_user_role_details_post()
        {
            $response   = $this->Admin_model->get_user_role_details();
            $this->response( $response );
        }
        #:-101-:##end
        function get_movie_count_post()
        {
            $response   = $this->Admin_model->get_movie_count();
            $this->response( $response );
        }
        function get_user_count_post()
        {
            $response   = $this->Admin_model->get_user_count();
            $this->response( $response );
        }
        function get_ads_count_post()
        {
            $response   = $this->Admin_model->get_ads_count();
            $this->response( $response );
        }
        function get_get_question_count()
        {
            $response   = $this->Admin_model->get_question_count();
            $this->response( $response );
        }    


    function get_dashboard_post()
    {
        $response   = $this->Admin_model->get_dashboard();
        $this->response( $response );
    }

    function get_collection_report_dt_list_post()
    {
        $response   = $this->Admin_model->get_collection_report_dt_list();
        $this->response( $response );
    }

    function get_viewers_collection_report_dt_list_post()
    {
        $response   = $this->Admin_model->get_viewers_collection_report_dt_list();
        $this->response( $response );
    }

    function get_payment_failure_report_dt_list_post()
    {
        $response   = $this->Admin_model->get_payment_failure_report_dt_list();
        $this->response( $response );
    }

    function get_winners_report_post()
    {
        $response   = $this->Admin_model->get_winners_report();
        $this->response( $response );
    }
    function get_association_report_dt_list_post()
    {
        $response   = $this->Admin_model->get_association_report_dt_list();
        $this->response( $response );
    }
    function generate_winners_post()
    {
        $response   = $this->Admin_model->generate_winners();
        $this->response( $response );
    }

    function add_winner_campaign_post()
    {
        $response   = $this->Admin_model->add_winner_campaign();
        $this->response( $response );
    }

    function send_winner_campaign_post()
    {
        $response   = $this->Admin_model->send_winner_campaign();
        $this->response( $response );
    }
    function delete_winner_campaign_post()
    {
        $response   = $this->Admin_model->delete_winner_campaign();
        $this->response( $response );
    }

    function get_winners_campaign_dt_list_post()
    {
        $response   = $this->Admin_model->get_winners_campaign_dt_list();
        $this->response( $response );
    }
    function get_sms_campaign_dt_list_post()
    {
        $response   = $this->Admin_model->get_sms_campaign_dt_list();
        $this->response( $response );
    }    
    function get_sms_template_dt_list_post()
    {
        $response   = $this->Admin_model->get_sms_template_dt_list();
        $this->response( $response );
    }
    function get_sms_template_list_post()
    {
        $response   = $this->Admin_model->get_sms_template_list();
        $this->response( $response );
    }      
    function insert_sms_template_post()
    {
        $response   = $this->Admin_model->insert_sms_template();
        $this->response( $response );
    }
    function delete_sms_template_post()
    {
        $response   = $this->Admin_model->delete_sms_template();
        $this->response( $response );
    }
    function get_sms_template_details_post()
    {
        $response   = $this->Admin_model->get_sms_template_details();
        $this->response( $response );
    }
    function add_sms_campaign_post()
    {
        $response   = $this->Admin_model->add_sms_campaign();
        $this->response( $response );
    }
    function send_sms_campaign_post()
    {
        $response   = $this->Admin_model->send_sms_campaign();
        $this->response( $response );
    }
    function get_cmspage_template_dt_list_post()
    {
        $response   = $this->Admin_model->get_cmspage_template_dt_list();
        $this->response( $response );
    }  
    function insert_cmspage_template_post()
    {
        $response   = $this->Admin_model->insert_cmspage_template();
        $this->response( $response );
    } 
    function delete_cmspage_template_post()
    {
        $response   = $this->Admin_model->delete_cmspage_template();
        $this->response( $response );
    }
    function get_cmspage_details_post()
    {
        $response   = $this->Admin_model->get_cmspage_details();
        $this->response( $response );
    }  
    function generate_winner_selection_option_post()
    {
        $response   = $this->Admin_model->generate_winner_selection_option();
        $this->response( $response );
    }                 
#next_function#
} ?>