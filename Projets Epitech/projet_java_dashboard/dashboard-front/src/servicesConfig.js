import WeatherDayForm from './components/dashboard/widgetsForms/WeatherDayForm';
import WeatherHoursForm from './components/dashboard/widgetsForms/WeatherHoursForm';
import GithubReposForm from './components/dashboard/widgetsForms/GithubReposForm';
import GithubRepoForm from './components/dashboard/widgetsForms/GithubRepoForm';
import DeezerTracksForm from './components/dashboard/widgetsForms/DeezerTracksForm';
import DeezerAlbumsForm from './components/dashboard/widgetsForms/DeezerAlbumsForm';

import LeMondeWidget from  './components/dashboard/widgets/LeMondeWidget';
import SciencesWidget from './components/dashboard/widgets/SciencesWidget';
import SeeEmailsWidget from './components/dashboard/widgets/SeeEmailsWidget';
import SendEmailWidget from './components/dashboard/widgets/SendEmailWidget';

const servicesConfig = [
  {
    name: 'Weather',
    widgets: [
      {
        name: 'Daily weather',
        type: 'weather_day',
        WidgetFormComponent: <WeatherDayForm />
      },
      {
        name: 'Weather per hour',
        type: 'weather_hours',
        WidgetFormComponent: <WeatherHoursForm />
      }
    ]
  },
  {
    name: 'Deezer',
    widgets: [
      {
        name: 'Search tracks',
        type: 'deezer_titles_search',
        WidgetFormComponent: <DeezerTracksForm />
      },
      {
        name: 'Search albums',
        type: 'deezer_albums_search',
        WidgetFormComponent: <DeezerAlbumsForm />
      }
    ]
  },
  {
    name: 'Tech news',
    widgets: [
      {
        name: 'Le monde informatique',
        type: 'news_le_monde',
        WidgetComponent: <LeMondeWidget />
      },
      {
        name: 'Sciences et avenir',
        type: 'news_science',
        WidgetComponent: <SciencesWidget />
      }
    ]
  },
  {
    name: 'Github',
    widgets: [
      {
        name: "User's repository",
        type: 'git_repos',
        WidgetFormComponent: <GithubReposForm />
      },
      {
        name: 'Repository details',
        type: 'git_one_repo',
        WidgetFormComponent: <GithubRepoForm />
      }
    ]
  },
  {
    name: 'Google',
    widgets: [
      {
        name: "See latest emails",
        type: 'google_see_emails',
        WidgetComponent: <SeeEmailsWidget />
      },
      {
        name: 'Send email',
        type: 'google_send_email',
        WidgetComponent: <SendEmailWidget />
      }
    ]
  }
];

export default servicesConfig;