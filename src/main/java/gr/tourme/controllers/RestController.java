package gr.tourme.controllers;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import gr.tourme.model.Adventure;

@Controller
public class RestController {
	private static final Logger logger = LoggerFactory.getLogger(RestController.class);

	@RequestMapping(value = "/rest", method = RequestMethod.GET, produces = "application/json;charset=UTF-8" )
	public @ResponseBody List<Adventure> testAdventures(
			@RequestParam(value = "count", defaultValue = "1") Integer count,
			Locale locale) {
		logger.debug("Called rest with count {}.", count);
		if (count<=0)
			return new ArrayList<Adventure>();
		
		ArrayList<Adventure> adventureList = new ArrayList<>(count);
		for (Integer i = 0; i < count; i++) {
			Adventure a = new Adventure();
			a.imageurl = i.toString();
			adventureList.add(a);
		}
		return adventureList;
	}

	
}
