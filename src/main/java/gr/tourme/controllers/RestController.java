package gr.tourme.controllers;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import java.util.Set;
import java.util.TreeSet;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import gr.tourme.db.AdventureDAO;
import gr.tourme.model.Adventure;

@Controller
public class RestController {
	private static final Logger logger = LoggerFactory.getLogger(RestController.class);

	@Autowired
	private AdventureDAO aDAO;	
	
	@CrossOrigin
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
			a.loc_photo_url = i.toString();
			adventureList.add(a);
		}
		return adventureList;
	}

	@CrossOrigin
	@RequestMapping(value = "/rest/{user_id}/adventures", method = RequestMethod.GET, produces = "application/json;charset=UTF-8" )
	public @ResponseBody List<Adventure> userAdventures(@PathVariable Integer user_id) {
		logger.debug("Called rest with user_id {}.", user_id);
		return aDAO.getAdventures(user_id);
	}

	@CrossOrigin
	@RequestMapping(value = "/rest/{user_id}/newadventure", method = RequestMethod.POST, consumes = "application/json;charset=UTF-8")
	@ResponseBody
	public String newAdventure(@RequestBody Adventure adventure, @PathVariable Integer user_id) {
		logger.debug("Received data for user " + user_id +", adventure: " + adventure);
		logger.info("imageurl: " + adventure.loc_photo_url);
		adventure.user_id = user_id;
		aDAO.insert(adventure);
		return "OK";
	}
	
	@CrossOrigin
	@RequestMapping(value = "/rest/{user_id}/suggestions", method = RequestMethod.GET, produces = "application/json;charset=UTF-8" )
	public @ResponseBody Set<Adventure> suggestedAdventures(@PathVariable Integer user_id) {
		List<Adventure> userAdventures = aDAO.getAdventures(user_id);
		// Get points close to Athens,Greeece
		// CALL get_close_points(37.983917, 23.7293599, 500.0, NULL, NULL, NULL);

		Set<Adventure> suggestions = new TreeSet<>();
		
		for (Adventure a:userAdventures)
		{
			suggestions.addAll(aDAO.getSuggestions(a.loc_latitude, a.loc_longitude, a.loc_radius_km, user_id));
			logger.debug("suggestions2: {}.", suggestions);			
		}
		logger.debug("Called suggestedAdventures with user_id {}.", user_id);
		return suggestions;
	}
}
