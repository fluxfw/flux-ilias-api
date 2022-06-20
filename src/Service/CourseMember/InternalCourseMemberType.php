<?php

namespace FluxIliasApi\Service\CourseMember;

// ilCourseConstants::CRS_ADMIN
// ilCourseConstants::CRS_MEMBER
// ilCourseConstants::CRS_TUTOR

enum InternalCourseMemberType: int
{

    case ADMINISTRATOR = 1;
    case MEMBER = 2;
    case TUTOR = 3;
}
