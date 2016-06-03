<?php
	namespace AppBundle\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Response;

	use AppBundle\Entity\Categories;
	use AppBundle\Entity\Rel;
	use AppBundle\Entity\Goods;

class GenusController extends Controller
{
    /**
     * @Route("/Site.com")
     */
    public function showAction()
    {
    	$em = $this->getDoctrine()->getManager();
		

		$query = $em->createQuery(
			'SELECT g
			 FROM AppBundle:Goods g
			');

		$goods = $query->getResult();
		$resArr = [];
		foreach ($goods as $good) {
			$data = [
				'id' => $good->getId(),
				'goodName' => $good->getName()
			];
			array_push($resArr, $data);
		}
		return $this->render('Site.com/show.html.twig', 
			Array ('data' => $resArr)//, 'category' => $category)
				);

    }

    /**
     * @Route("/Site.com/{category}")
     */
    public function navAction($category)
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery(
			'SELECT c
			 FROM AppBundle:Categories c
			');

    	$categories = $query->getResult();
		$resArr = [];
		foreach ($categories as $cat) {
			$data = [
				'id' => $cat->getId(),
				'catName' => $cat->getName()
			];
			array_push($resArr, $data);
		}

		$render = $this->render('Site.com/cat.html.twig', 
			Array ('data' => $resArr)
				);

		if($category!='all_cats')
		{
			$repository = $this->getDoctrine()->getRepository('AppBundle:Categories');
			$ad_cat = $repository->findOneByName($category);

			$query = $em->createQuery(
			'SELECT g
			 FROM AppBundle:Goods g
			 JOIN AppBundle:Rel r WHERE r.gdId = g.id
			 JOIN AppBundle:Categories c WHERE r.catId = c.id
			 WHERE c.id = :c_id 
			')->setParameter('c_id', $ad_cat->getId());

			$filter = $query->getResult();
			$resGood = [];
			foreach ($filter as $fl) {

			$data = [
				'id' => $fl->getId(),
				'gName' => $fl->getName()
			];

			array_push($resGood, $data);
			}
			$render = $this->render('Site.com/catngood.html.twig', 
			Array ('data' => $resArr, 'gdata' => $resGood)
				);
		}
    	return ($render);
    }
}