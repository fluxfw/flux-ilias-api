<?php

namespace FluxIliasApi\Service\Course;

use FluxIliasApi\Libs\FluxLegacyEnum\Adapter\Backed\LegacyIntBackedEnum;

// ilCourseConstants::MAIL_ALLOWED_ALL
// ilCourseConstants::MAIL_ALLOWED_TUTORS

/**
 * @method static static ALL() 1
 * @method static static TUTORS_AND_ADMINISTRATORS() 2
 */
class LegacyInternalCourseMailToMembersType extends LegacyIntBackedEnum
{

}
