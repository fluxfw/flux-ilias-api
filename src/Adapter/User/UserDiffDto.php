<?php

namespace FluxIliasApi\Adapter\User;

class UserDiffDto
{

    public ?int $access_limited_from;
    public ?bool $access_limited_message;
    public ?int $access_limited_object_id;
    public ?string $access_limited_object_import_id;
    public ?int $access_limited_object_ref_id;
    public ?int $access_limited_until;
    public ?bool $access_unlimited;
    public ?bool $active;
    public ?LegacyUserAuthenticationMode $authentication_mode;
    public ?string $birthday;
    public ?string $city;
    public ?string $client_ip;
    public ?string $country;
    public ?string $department;
    public ?string $email;
    public ?string $external_account;
    public ?string $fax;
    public ?string $first_name;
    public ?LegacyUserGender $gender;
    /**
     * @var string[]|null
     */
    public ?array $general_interests;
    public ?string $heard_about_ilias;
    public ?string $hobbies;
    public ?string $import_id;
    public ?string $institution;
    public ?LegacyUserLanguage $language;
    public ?string $last_name;
    public ?string $location_latitude;
    public ?string $location_longitude;
    public ?int $location_zoom;
    public ?string $login;
    /**
     * @var string[]|null
     */
    public ?array $looking_for_helps;
    public ?string $matriculation_number;
    /**
     * @var string[]|null
     */
    public ?array $offering_helps;
    public ?string $password;
    public ?string $phone_home;
    public ?string $phone_mobile;
    public ?string $phone_office;
    public ?string $second_email;
    public ?LegacyUserSelectedCountry $selected_country;
    public ?string $street;
    public ?string $title;
    /**
     * @var UserDefinedFieldDto[]|null
     */
    public ?array $user_defined_fields;
    public ?string $zip_code;


    /**
     * @param string[]|null              $general_interests
     * @param string[]|null              $offering_helps
     * @param string[]|null              $looking_for_helps
     * @param UserDefinedFieldDto[]|null $user_defined_fields
     */
    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $external_account,
        /*public readonly*/ ?LegacyUserAuthenticationMode $authentication_mode,
        /*public readonly*/ ?string $login,
        /*public readonly*/ ?string $password,
        /*public readonly*/ ?bool $active,
        /*public readonly*/ ?bool $access_unlimited,
        /*public readonly*/ ?int $access_limited_from,
        /*public readonly*/ ?int $access_limited_until,
        /*public readonly*/ ?int $access_limited_object_id,
        /*public readonly*/ ?string $access_limited_object_import_id,
        /*public readonly*/ ?int $access_limited_object_ref_id,
        /*public readonly*/ ?bool $access_limited_message,
        /*public readonly*/ ?LegacyUserGender $gender,
        /*public readonly*/ ?string $first_name,
        /*public readonly*/ ?string $last_name,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $birthday,
        /*public readonly*/ ?string $institution,
        /*public readonly*/ ?string $department,
        /*public readonly*/ ?string $street,
        /*public readonly*/ ?string $city,
        /*public readonly*/ ?string $zip_code,
        /*public readonly*/ ?string $country,
        /*public readonly*/ ?LegacyUserSelectedCountry $selected_country,
        /*public readonly*/ ?string $phone_office,
        /*public readonly*/ ?string $phone_home,
        /*public readonly*/ ?string $phone_mobile,
        /*public readonly*/ ?string $fax,
        /*public readonly*/ ?string $email,
        /*public readonly*/ ?string $second_email,
        /*public readonly*/ ?string $hobbies,
        /*public readonly*/ ?string $heard_about_ilias,
        /*public readonly*/ ?array $general_interests,
        /*public readonly*/ ?array $offering_helps,
        /*public readonly*/ ?array $looking_for_helps,
        /*public readonly*/ ?string $matriculation_number,
        /*public readonly*/ ?string $client_ip,
        /*public readonly*/ ?string $location_latitude,
        /*public readonly*/ ?string $location_longitude,
        /*public readonly*/ ?int $location_zoom,
        /*public readonly*/ ?array $user_defined_fields,
        /*public readonly*/ ?LegacyUserLanguage $language
    ) {
        $this->import_id = $import_id;
        $this->external_account = $external_account;
        $this->authentication_mode = $authentication_mode;
        $this->login = $login;
        $this->password = $password;
        $this->active = $active;
        $this->access_unlimited = $access_unlimited;
        $this->access_limited_from = $access_limited_from;
        $this->access_limited_until = $access_limited_until;
        $this->access_limited_object_id = $access_limited_object_id;
        $this->access_limited_object_import_id = $access_limited_object_import_id;
        $this->access_limited_object_ref_id = $access_limited_object_ref_id;
        $this->access_limited_message = $access_limited_message;
        $this->gender = $gender;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->title = $title;
        $this->birthday = $birthday;
        $this->institution = $institution;
        $this->department = $department;
        $this->street = $street;
        $this->city = $city;
        $this->zip_code = $zip_code;
        $this->country = $country;
        $this->selected_country = $selected_country;
        $this->phone_office = $phone_office;
        $this->phone_home = $phone_home;
        $this->phone_mobile = $phone_mobile;
        $this->fax = $fax;
        $this->email = $email;
        $this->second_email = $second_email;
        $this->hobbies = $hobbies;
        $this->heard_about_ilias = $heard_about_ilias;
        $this->general_interests = $general_interests;
        $this->offering_helps = $offering_helps;
        $this->looking_for_helps = $looking_for_helps;
        $this->matriculation_number = $matriculation_number;
        $this->client_ip = $client_ip;
        $this->location_latitude = $location_latitude;
        $this->location_longitude = $location_longitude;
        $this->location_zoom = $location_zoom;
        $this->user_defined_fields = $user_defined_fields;
        $this->language = $language;
    }


    /**
     * @param string[]|null              $general_interests
     * @param string[]|null              $offering_helps
     * @param string[]|null              $looking_for_helps
     * @param UserDefinedFieldDto[]|null $user_defined_fields
     */
    public static function new(
        ?string $import_id = null,
        ?string $external_account = null,
        ?LegacyUserAuthenticationMode $authentication_mode = null,
        ?string $login = null,
        ?string $password = null,
        ?bool $active = null,
        ?bool $access_unlimited = null,
        ?int $access_limited_from = null,
        ?int $access_limited_until = null,
        ?int $access_limited_object_id = null,
        ?string $access_limited_object_import_id = null,
        ?int $access_limited_object_ref_id = null,
        ?bool $access_limited_message = null,
        ?LegacyUserGender $gender = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $title = null,
        ?string $birthday = null,
        ?string $institution = null,
        ?string $department = null,
        ?string $street = null,
        ?string $city = null,
        ?string $zip_code = null,
        ?string $country = null,
        ?LegacyUserSelectedCountry $selected_country = null,
        ?string $phone_office = null,
        ?string $phone_home = null,
        ?string $phone_mobile = null,
        ?string $fax = null,
        ?string $email = null,
        ?string $second_email = null,
        ?string $hobbies = null,
        ?string $heard_about_ilias = null,
        ?array $general_interests = null,
        ?array $offering_helps = null,
        ?array $looking_for_helps = null,
        ?string $matriculation_number = null,
        ?string $client_ip = null,
        ?string $location_latitude = null,
        ?string $location_longitude = null,
        ?int $location_zoom = null,
        ?array $user_defined_fields = null,
        ?LegacyUserLanguage $language = null
    ) : /*static*/ self
    {
        return new static(
            $import_id,
            $external_account,
            $authentication_mode,
            $login,
            $password,
            $active,
            $access_unlimited,
            $access_limited_from,
            $access_limited_until,
            $access_limited_object_id,
            $access_limited_object_import_id,
            $access_limited_object_ref_id,
            $access_limited_message,
            $gender,
            $first_name,
            $last_name,
            $title,
            $birthday,
            $institution,
            $department,
            $street,
            $city,
            $zip_code,
            $country,
            $selected_country,
            $phone_office,
            $phone_home,
            $phone_mobile,
            $fax,
            $email,
            $second_email,
            $hobbies,
            $heard_about_ilias,
            $general_interests,
            $offering_helps,
            $looking_for_helps,
            $matriculation_number,
            $client_ip,
            $location_latitude,
            $location_longitude,
            $location_zoom,
            $user_defined_fields,
            $language
        );
    }


    public static function newFromObject(
        object $diff
    ) : /*static*/ self
    {
        return static::new(
            $diff->import_id ?? null,
            $diff->external_account ?? null,
            ($authentication_mode = $diff->authentication_mode ?? null) !== null ? LegacyUserAuthenticationMode::from($authentication_mode) : null,
            $diff->login ?? null,
            $diff->password ?? null,
            $diff->active ?? null,
            $diff->access_unlimited ?? null,
            $diff->access_limited_from ?? null,
            $diff->access_limited_until ?? null,
            $diff->access_limited_object_id ?? null,
            $diff->access_limited_object_import_id ?? null,
            $diff->access_limited_object_ref_id ?? null,
            $diff->access_limited_message ?? null,
            ($gender = $diff->gender ?? null) !== null ? LegacyUserGender::from($gender) : null,
            $diff->first_name ?? null,
            $diff->last_name ?? null,
            $diff->title ?? null,
            $diff->birthday ?? null,
            $diff->institution ?? null,
            $diff->department ?? null,
            $diff->street ?? null,
            $diff->city ?? null,
            $diff->zip_code ?? null,
            $diff->country ?? null,
            ($selected_country = $diff->selected_country ?? null) !== null ? LegacyUserSelectedCountry::from($selected_country) : null,
            $diff->phone_office ?? null,
            $diff->phone_home ?? null,
            $diff->phone_mobile ?? null,
            $diff->fax ?? null,
            $diff->email ?? null,
            $diff->second_email ?? null,
            $diff->hobbies ?? null,
            $diff->heard_about_ilias ?? null,
            $diff->general_interests ?? null,
            $diff->offering_helps ?? null,
            $diff->looking_for_helps ?? null,
            $diff->matriculation_number ?? null,
            $diff->client_ip ?? null,
            $diff->location_latitude ?? null,
            $diff->location_longitude ?? null,
            $diff->location_zoom ?? null,
            ($user_defined_fields = $diff->user_defined_fields ?? null) !== null ? array_map([UserDefinedFieldDto::class, "newFromObject"], $user_defined_fields) : null,
            ($language = $diff->language ?? null) !== null ? LegacyUserLanguage::from($language) : null
        );
    }
}
