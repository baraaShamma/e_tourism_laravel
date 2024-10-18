<?php
namespace App\Http\Controllers\Api\Admin\guide;

use App\Services\GuideService;
use App\Http\Controllers\Api\BaseController;
use App\Models\User;


class GuideController extends BaseController
{
    private $guideService;

    public function __construct(GuideService $guideService)
    {
        $this->guideService = $guideService;
    }

 
    public function getGuides()
    {
        $guides = $this->guideService->getGuide();
        return $this->sendResponse($guides, 'All buss retrieved successfully.');
    }
    public function destroy(User $user)
    {
        $this->guideService->deleteGuide($user);
        return $this->sendResponse([], 'guide deleted successfully.');
    }
}
